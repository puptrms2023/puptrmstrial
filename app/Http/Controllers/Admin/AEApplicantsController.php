<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use App\Models\Summary;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\AcademicExcellence;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AEApplicantsController extends Controller
{
    public function index()
    {
        $courses = Courses::all();
        return view('admin.academic-excellence-award.index', compact('courses'));
    }
    public function achieversView(Request $request, $course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();

        if ($request->ajax()) {
            $data = AcademicExcellence::with('users')->with('courses')->where('ae_applicants.course_id', $courses->id)->select('ae_applicants.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($status) {
                    $url = asset('uploads/' . $status->image);
                    return '<img src="' . $url . '" class="img-thumbnail img-circle"
                    width="50" alt="Image">';
                })
                ->addColumn('status', function ($status) {
                    if ($status->status == '1') {
                        return '<span class="badge badge-success">Approved</span>';
                    } else if ($status->status == '2') {
                        return '<span class="badge badge-danger">Rejected</span>';
                    } else {
                        return '<a href="/admin/academic-excellence-award/' . $status->courses->course_code . '/approve/' . $status->id . '" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Approve</span>
                    </a>
                    <a href="/admin/academic-excellence-award/' . $status->courses->course_code . '/reject/' . $status->id . '" class="btn btn-danger btn-sm btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fa-sharp fa-solid fa-xmark"></i>
                        </span>
                        <span class="text">Reject</span>
                    </a>';
                    }
                })
                ->addColumn('action', function ($status) {
                    $btn = '';
                    $btn .= '<a href="/admin/academic-excellence-award/' . $status->courses->course_code . '/' . $status->id . '" class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i> </a> ';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-sm btn-danger deleteFormbtn" data-id="' . $status->id . '"><i class="fa fa-trash"></i> </button>';

                    return $btn;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                        $instance->where('status', $request->get('status'));
                    }

                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('gwa', 'LIKE', "%$search%");
                        });
                    }
                    // $instance->orwhereHas('users', function ($q) use ($request) {
                    //     $searchData = $request->get('search');
                    //     $q->orWhere('first_name', 'LIKE', "%$$searchData%")
                    //         ->orWhere('last_name', 'LIKE', "%$$searchData%");
                    // });
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.academic-excellence-award.view', compact('courses'));
    }

    public function studentApplicationView($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $status = AcademicExcellence::where('course_id', $courses->id)->get();
        $status = AcademicExcellence::find($id);
        $grades = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "1")
            ->where('app_id', '=', $id)
            ->get();
        $grades2 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "2")
            ->where('app_id', '=', $id)
            ->get();
        $grades3 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "3")
            ->where('app_id', '=', $id)
            ->get();
        $grades4 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "4")
            ->where('app_id', '=', $id)
            ->get();
        $grades5 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "5")
            ->where('app_id', '=', $id)
            ->get();
        $grades6 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "6")
            ->where('app_id', '=', $id)
            ->get();
        $grades7 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "7")
            ->where('app_id', '=', $id)
            ->get();
        $grades8 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "8")
            ->where('app_id', '=', $id)
            ->get();
        return view('admin.academic-excellence-award.student', compact('courses', 'status', 'grades', 'grades2', 'grades3', 'grades4', 'grades5', 'grades6', 'grades7', 'grades8'));
    }

    public function approved($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $approve = AcademicExcellence::where('course_id', $courses->id)->get();
        $approve = AcademicExcellence::find($id);
        $approve->status = 1;
        $approve->save();
        return redirect()->back();
    }

    public function rejected($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $reject = AcademicExcellence::where('course_id', $courses->id)->get();
        $reject = AcademicExcellence::find($id);
        $reject->status = 2;
        $reject->save();
        return redirect()->back();
    }

    public function update(Request $request, $course_code, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'reason' => 'nullable'
        ]);

        $courses = Courses::where('course_code', $course_code)->first();
        $status = AcademicExcellence::where('course_id', $courses->id)->get();
        $status = AcademicExcellence::findOrFail($id);

        $status->status = $request->status;
        $status->reason = $request->reason;
        $status->save();
        return redirect()->back()->with('success', 'The Application form updated successfully');
    }

    public function openPdfApproved($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = AcademicExcellence::where('course_id', $courses->id)
            ->where('status', '1')
            ->orderBy('gwa', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.academic-excellence-award.student-accepted', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Academic-Excellence-Awardee-' . $courses->course_code . '.pdf');
    }

    public function openPdfRejected($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = AcademicExcellence::where('course_id', $courses->id)
            ->where('status', '2')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.academic-excellence-award.student-rejected', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Rejected-Academic-Excellence-Awardee-' . $courses->course_code . '.pdf');
    }

    public function openPdfAll($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = AcademicExcellence::where('course_id', $courses->id)
            ->orderBy('year_level', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.academic-excellence-award.student-list', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Academic-Excellence-Awardee-Applicants-' . $courses->course_code . '.pdf');
    }

    public function destroy(Request $request)
    {
        $form = AcademicExcellence::find($request->form_delete_id);
        if ($form->image) {
            $path = 'uploads/' . $form->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $form->delete();
        return redirect()->back()->with('success', 'The Application form deleted successfully');
    }
}
