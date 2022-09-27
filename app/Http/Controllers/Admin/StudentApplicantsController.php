<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use App\Models\Summary;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\StudentApplicants;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
            if ($request->get('status') == '') {
                $model = StudentApplicants::with('users', 'courses')->where('student_applicants.course_id', $courses->id)->where('award_applied', '1');
            } else {
                $model = StudentApplicants::with('users', 'courses')->where('student_applicants.course_id', $courses->id)->where('award_applied', '1')->where('status', $request->get('status'));
            }
            return DataTables::eloquent($model)
                ->addColumn('studno', function (StudentApplicants $post) {
                    return $post->users->stud_num;
                })
                ->addColumn('fname', function (StudentApplicants $post) {
                    return $post->users->first_name;
                })
                ->addColumn('lname', function (StudentApplicants $post) {
                    return $post->users->last_name;
                })
                ->addColumn('course', function (StudentApplicants $post) {
                    return $post->courses->course_code;
                })
                ->addColumn('image', function ($status) {
                    $url = asset('uploads/' . $status->image);
                    return '<img src="' . $url . '" class="img-thumbnail img-circle"
                                    width="50" alt="Image">';
                })
                ->addColumn('status', function (StudentApplicants $data) {
                    if ($data->status == '1') {
                        return '<span class="badge badge-success">Approved</span>';
                    } else if ($data->status == '2') {
                        return '<span class="badge badge-danger">Rejected</span>';
                    } else {
                        return '<a href="/admin/achievers-award/' . $data->courses->course_code . '/approve/' . $data->id . '" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Approve</span>
                    </a>
                    <a href="/admin/achievers-award/' . $data->courses->course_code . '/reject/' . $data->id . '" class="btn btn-danger btn-sm btn-icon-split" >
                        <span class="icon text-white-50">
                            <i class="fa-sharp fa-solid fa-xmark"></i>
                        </span>
                        <span class="text">Reject</span>
                    </a>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '';
                    $btn .= '<a href="/admin/achievers-award/' . $data->courses->course_code . '/' . $data->id . '" class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i> </a> ';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-sm btn-danger deleteFormbtn" data-id="' . $data->id . '"><i class="fa fa-trash"></i> </button>';

                    return $btn;
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
        // $courses = Courses::where('course_code', $course_code)->first();
        $status = StudentApplicants::where('course_id', $courses->id)->first();
        $status = StudentApplicants::find($id);
        $grades = Summary::where('user_id', $id)
            ->where('term', '=', "1")
            ->where('app_id', '=', $id)
            ->get();
        $grades2 = Summary::where('user_id', $id)
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
        return redirect()->back()->with('success', 'The Application form updated successfully');
    }

    public function certificate($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::with('users')->find($id);
        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate($students->users->stud_num));

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.achievers-award.certificate', array('students' => $students), array('qrcode' => $qrcode));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Achievers-Awardee-' . $courses->course_code . '.pdf');
    }

    public function openPdfApproved($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::where('award_applied', '1')
            ->where('course_id', $courses->id)
            ->where('status', '1')
            ->orderBy('gwa', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.achievers-award.student-accepted', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Achievers-Awardee-' . $courses->course_code . '.pdf');
    }
    public function openPdfRejected($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::where('award_applied', '1')
            ->where('course_id', $courses->id)
            ->where('status', '2')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.achievers-award.student-rejected', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Rejected-Achiever-Awardee-' . $courses->course_code . '.pdf');
    }

    public function openPdfAll($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::where('award_applied', '1')
            ->where('course_id', $courses->id)
            ->orderBy('year_level', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.achievers-award.student-list', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Achievers-Awardee-Applicants-' . $courses->course_code . '.pdf');
    }

    public function destroy(Request $request)
    {
        $form = StudentApplicants::find($request->form_delete_id);
        if ($form->image) {
            $path = 'uploads/' . $form->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $form->delete();
        return redirect()->back()->with('success', 'The Application form deleted successfully');
    }

    public function overallList()
    {
        return view('admin.achievers-award.overall');
    }
}
