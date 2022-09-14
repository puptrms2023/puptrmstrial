<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courses;
use App\Models\Summary;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\StudentApplicants;
use App\Http\Controllers\Controller;

class StudentApplicantsController extends Controller
{
    public function index()
    {
        $courses = Courses::all();
        return view('admin.achievers-award.index', compact('courses'));
    }

    public function achieversView(Request $request, $course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();

        if ($request->ajax()) {
            $data = StudentApplicants::with('users', 'courses')->where('student_applicants.course_id', $courses->id)->where('award_applied', '1')->select('student_applicants.*');
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
                        return '<a href="/admin/achievers-award/' . $status->courses->course_code . '/approve/' . $status->id . '" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Approve</span>
                    </a>
                    <a href="/admin/achievers-award/' . $status->courses->course_code . '/reject/' . $status->id . '" class="btn btn-danger btn-sm btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fa-sharp fa-solid fa-xmark"></i>
                        </span>
                        <span class="text">Reject</span>
                    </a>';
                    }
                })
                ->addColumn('action', function ($status) {
                    $btn = '';
                    $btn .= '<a href="/admin/achievers-award/' . $status->courses->course_code . '/' . $status->id . '" class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i> </a> ';
                    $btn .= '<button type="button" class="btn btn-sm btn-danger deleteUserbtn"><i class="fa fa-trash"></i> </button>';

                    return $btn;
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                        $instance->where('status', $request->get('status'));
                    }

                    if (!empty($request->get('search'))) {
                        $instance->where(function ($w) use ($request) {
                            $search = $request->get('search');
                            $w->orWhere('gwa_1st', 'LIKE', "%$search%")
                                ->orWhere('gwa_2nd', 'LIKE', "%$search%");
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

        return view('admin.achievers-award.view', compact('courses'));
    }

    public function approved($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $approve = StudentApplicants::where('course_id', $courses->id)->get();
        $approve = StudentApplicants::find($id);
        $approve->status = 1;
        $approve->save();
        return redirect()->back();
    }
    public function rejected($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $reject = StudentApplicants::where('course_id', $courses->id)->get();
        $reject = StudentApplicants::find($id);
        $reject->status = 2;
        $reject->save();
        return redirect()->back();
    }

    public function studentApplicationView($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $status = StudentApplicants::where('course_id', $courses->id)->get();
        $status = StudentApplicants::find($id);
        $grades = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "1")
            ->where('app_id', '=', $id)
            ->get();
        $grades2 = Summary::where('user_id', $status->user_id)
            ->where('term', '=', "2")
            ->where('app_id', '=', $id)
            ->get();
        return view('admin.achievers-award.student', compact('courses', 'status', 'grades', 'grades2'));
    }

    public function update(Request $request, $course_code, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'reason' => 'nullable'
        ]);

        $courses = Courses::where('course_code', $course_code)->first();
        $status = StudentApplicants::where('course_id', $courses->id)->get();
        $status = StudentApplicants::findOrFail($id);

        $status->status = $request->status;
        $status->reason = $request->reason;
        $status->save();
        return redirect()->back()->with('message', 'The Application Form Updated Successfully');
    }
    public function openPdfApproved($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::where('award_applied','1')
        ->where('course_id', $courses->id)
        ->where('status', '1')
        ->orderBy('gwa','asc')
        ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.achievers-award.student-accepted',array('students' => $students),array('courses' => $courses));
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('Achievers-Awardee-'.$courses->course_code.'.pdf');
    }
    public function openPdfRejected($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::where('award_applied','1')
        ->where('course_id', $courses->id)
        ->where('status', '2')
        ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.achievers-award.student-rejected',array('students' => $students),array('courses' => $courses));
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('Rejected-Achiever-Awardee-'.$courses->course_code.'.pdf');
    }

    public function openPdfAll($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::where('award_applied','1')
        ->where('course_id', $courses->id)
        ->orderBy('year_level','asc')
        ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.achievers-award.student-list',array('students' => $students),array('courses' => $courses));
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('Achievers-Awardee-Applicants-'.$courses->course_code.'.pdf');
    }
}
