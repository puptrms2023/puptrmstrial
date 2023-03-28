<?php

namespace App\Http\Controllers\Admin\Applicant;

use App\Models\User;
use App\Models\Reason;
use App\Models\NonAcadAward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Leadership;
use App\Models\Leadership_Criteria;
use App\Models\NonAcademicApplicant;
use App\Models\Outstanding_Org;
use Illuminate\Support\Facades\File;
use App\Notifications\NonAcademicStatus;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StudentApplicantStatus;

class NAApplicantsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:non-academic award list', ['only' => ['index', 'overallList', 'view']]);
        $this->middleware('permission:non-academic award edit', ['only' => ['update', 'approved', 'rejected']]);
        $this->middleware('permission:non-academic award delete', ['only' => ['destroy', 'deleteAll']]);
    }

    public function index()
    {
        $nonacad = NonAcadAward::withCount(['nonacad_applicants as applicant_count' => function ($query) {
            $query->where('status', 0)->where('school_year', getAcademicYear());
        }])
            ->get();

        return view('admin.non-academic-award.index', compact('nonacad'));
    }

    public function details($nonacad_id, $id)
    {
        $form = NonAcademicApplicant::with('academics', 'projects', 'officership', 'awards', 'community_outreach', 'interviews', 'leadership_criteria', 'outstanding_criteria', 'financials', 'affiliations')->where('id', $id)->first();
        $reasons = Reason::pluck('description', 'id');
        return view('admin.non-academic-award.show', compact('form', 'reasons'));
    }

    public function overallList()
    {
        $form = NonAcademicApplicant::where('school_year', getAcademicYear())->get();
        return view('admin.non-academic-award.all', compact('form'));
    }

    public function view(Request $request, $id)
    {
        $title = NonAcadAward::where('id', $id)->first();
        $form = NonAcademicApplicant::where('nonacad_id', $id)->where('school_year', getAcademicYear())->get();

        return view('admin.non-academic-award.view', compact('title', 'form'));
    }

    public function approved($nonacad_id, $id)
    {
        $approve = NonAcademicApplicant::find($id);
        $users = User::where('id', $approve->user_id)->get();
        $award = $approve->nonacad->nonacad_code;
        $approve->status = 1;

        $approve->save();

        Notification::send($users, new StudentApplicantStatus($approve->id, $approve->status, $award));
        return redirect()->back();
    }
    public function rejected($nonacad_id, $id)
    {
        $reject = NonAcademicApplicant::find($id);
        $users = User::where('id', $reject->user_id)->get();
        $award = $reject->nonacad->nonacad_code;
        $reject->status = 2;

        $reject->save();

        Notification::send($users, new StudentApplicantStatus($reject->id, $reject->status, $award));
        return redirect()->back();
    }

    public function update(Request $request, $nonacad_id, $id)
    {
        // dd($request->all());
        $this->validate($request, [
            'status' => 'required',
            'reason' => 'nullable',
            'total' => ['nullable', 'numeric', 'max:100'],
        ]);
        $status = NonAcademicApplicant::findOrFail($id);

        $status->status = $request->status;
        $status->reason = $request->reason;
        $status->others = $request->others;
        $award = $status->nonacad->nonacad_code;

        $users = User::where('id', $status->user_id)->get();
        $status->save();

        if ($nonacad_id == '1') {
            Leadership_Criteria::updateOrCreate(
                ['n_id' => $id],
                [
                    'academic_performance' => $request->acad_perf,
                    'projects_initiated' => $request->project_initiated,
                    'officership' => $request->officership,
                    'awards_received' => $request->awards,
                    'community_outreach' => $request->community_out,
                    'interview' => $request->interview
                ]
            );
        }
        if ($nonacad_id == '3') {
            Outstanding_Org::updateOrCreate(
                ['n_id' => $id],
                [
                    'projects_initiated' => $request->project_initiated,
                    'awards_received' => $request->awards,
                    'community_involvement' => $request->community_involvement,
                    'affiliation' => $request->affiliation,
                    'financial_statement' => $request->financial_statement
                ]
            );
        }

        if ($request->status == '1' || $request->status == '2') {
            Notification::send($users, new StudentApplicantStatus($status->id, $request->status, $award));
        }

        return redirect()->back()->with('success', 'The Application form updated successfully');
    }

    public function openPdfApproved($nonacad_code)
    {
        $nonacad = NonAcadAward::where('nonacad_code', $nonacad_code)->first();
        $students = NonAcademicApplicant::where('nonacad_id', $nonacad->id)
            ->where('status', '1')
            ->where('school_year', getAcademicYear())
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.non-academic-award.student-accepted', array('students' => $students), array('nonacad' => $nonacad));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Accepted' . $nonacad->nonacad_code . '.pdf');
    }

    public function openPdfRejected($nonacad_code)
    {
        $nonacad = NonAcadAward::where('nonacad_code', $nonacad_code)->first();
        $students = NonAcademicApplicant::where('nonacad_id', $nonacad->id)
            ->where('status', '2')
            ->where('school_year', getAcademicYear())
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.non-academic-award.student-rejected', array('students' => $students), array('nonacad' => $nonacad));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Rejected' . $nonacad->nonacad_code . '.pdf');
    }

    public function openPdfAll($nonacad_code)
    {
        $nonacad = NonAcadAward::where('nonacad_code', $nonacad_code)->first();
        $students = NonAcademicApplicant::where('nonacad_id', $nonacad->id)
            ->where('school_year', getAcademicYear())
            ->orderBy('year_level', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.non-academic-award.student-list', array('students' => $students), array('nonacad' => $nonacad));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Non-Academic-Applicants-' . $nonacad->nonacad_code . '.pdf');
    }

    public function destroy(Request $request)
    {
        $form = NonAcademicApplicant::find($request->form_delete_id);
        $form->delete();
        return redirect()->back()->with('success', 'The Application form move to archive successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        NonAcademicApplicant::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'The Application form move to archive successfully'
        ]);
    }
}
