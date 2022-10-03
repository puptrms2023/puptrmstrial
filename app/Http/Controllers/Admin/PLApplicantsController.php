<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courses;
use App\Models\Summary;
use Illuminate\Http\Request;
use App\Models\StudentApplicants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class PLApplicantsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu academic awards', ['only' => ['index', 'achieversView', 'approved', 'rejected', 'studentApplicationView', 'update', 'openPdfApproved', 'openPdfRejected', 'openPdfAll', 'overallList']]);
        $this->middleware('permission:presidents list list', ['only' => ['index', 'achieversView', 'approved', 'rejected', 'studentApplicationView', 'update', 'openPdfApproved', 'openPdfRejected', 'openPdfAll', 'overallList']]);
        $this->middleware('permission:presidents list edit', ['only' => ['studentApplicationView', 'update', 'approved', 'rejected']]);
        $this->middleware('permission:presidents list delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $courses = Courses::all();
        $pending = StudentApplicants::where('award_applied', '3')->where('status', '0')->count();
        return view('admin.presidents-list-award.index', compact('courses', 'pending'));
    }

    public function achieversView(Request $request, $course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $model = StudentApplicants::with('users', 'courses')
            ->where('student_applicants.course_id', $courses->id)
            ->where('award_applied', '3')
            ->select('student_applicants.*');

        if ($request->ajax()) {
            if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                $model->where('status', $request->get('status'))->get();
            }

            if ($request->get('year') == '2nd-Year' || $request->get('year') == '3rd-Year' || $request->get('year') == '4th-Year') {
                $year = str_replace('-', ' ', $request->get('year'));
                $model->where('year_level', $year)->get();
            }

            return DataTables::eloquent($model)
                ->addColumn('studno', function (StudentApplicants $stud) {
                    return $stud->users->stud_num;
                })
                ->addColumn('fname', function (StudentApplicants $stud) {
                    return $stud->users->first_name;
                })
                ->addColumn('lname', function (StudentApplicants $stud) {
                    return $stud->users->last_name;
                })
                ->addColumn('course', function (StudentApplicants $stud) {
                    return $stud->courses->course_code;
                })
                ->addColumn('image', function ($data) {
                    $url = asset('uploads/' . $data->image);
                    return '<img src="' . $url . '" class="img-thumbnail img-circle"
                                    width="50" alt="Image">';
                })
                ->addColumn('status', function (StudentApplicants $data) {
                    return view('admin.presidents-list-award.action.status', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.presidents-list-award.action.buttons', compact('data'));
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.presidents-list-award.view', compact('courses'));
    }

    public function approved($course_code, $id)
    {
        $approve = StudentApplicants::find($id);
        $approve->status = 1;
        $approve->save();
        return redirect()->back();
    }
    public function rejected($course_code, $id)
    {
        $reject = StudentApplicants::find($id);
        $reject->status = 2;
        $reject->save();
        return redirect()->back();
    }

    public function studentApplicationView($course_code, $id)
    {
        $status = StudentApplicants::with('users')->where('id', $id)->first();
        $grades = Summary::where('app_id', $id)
            ->where('term', "1")
            ->get();
        $grades2 = Summary::where('app_id', $id)
            ->where('term', "2")
            ->get();
        return view('admin.presidents-list-award.student', compact('status', 'grades', 'grades2'));
    }

    public function update(Request $request, $course_code, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'reason' => 'nullable'
        ]);

        $status = StudentApplicants::findOrFail($id);

        $status->status = $request->status;
        $status->reason = $request->reason;
        $status->save();
        return redirect()->back()->with('success', 'The Application form updated successfully');
    }

    public function openPdfApproved($course_code, $year_level)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        if ($year_level == "All") {
            $students = StudentApplicants::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('status', '1')
                ->orderBy('gwa', 'asc')
                ->get();
        } else {
            $year = str_replace('-', ' ', $year_level);
            $courses = Courses::where('course_code', $course_code)->first();
            $students = StudentApplicants::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('year_level', $year)
                ->where('status', '1')
                ->orderBy('gwa', 'asc')
                ->get();
        }
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.presidents-list-award.student-accepted', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Deans-List-' . $courses->course_code . '.pdf');
    }
    public function openPdfRejected($course_code, $year_level)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        if ($year_level == "All") {
            $students = StudentApplicants::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('status', '2')
                ->orderBy('gwa', 'asc')
                ->get();
        } else {
            $year = str_replace('-', ' ', $year_level);
            $courses = Courses::where('course_code', $course_code)->first();
            $students = StudentApplicants::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('year_level', $year)
                ->where('status', '2')
                ->orderBy('gwa', 'asc')
                ->get();
        }
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.presidents-list-award.student-rejected', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Rejected-Deans-List-' . $courses->course_code . '.pdf');
    }

    public function openPdfAll($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = StudentApplicants::where('award_applied', '3')
            ->where('course_id', $courses->id)
            ->orderBy('year_level', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.presidents-list-award.student-list', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Deans-List-Applicants-' . $courses->course_code . '.pdf');
    }

    public function overallList(Request $request)
    {
        if ($request->ajax()) {
            if ($request->ajax()) {
                $model = StudentApplicants::with('users', 'courses')->where('award_applied', '3')->select('student_applicants.*');
                if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                    $model->where('status', $request->get('status'))->get();
                }
                return DataTables::eloquent($model)
                    ->addColumn('studno', function (StudentApplicants $stud) {
                        return $stud->users->stud_num;
                    })
                    ->addColumn('fname', function (StudentApplicants $stud) {
                        return $stud->users->first_name;
                    })
                    ->addColumn('lname', function (StudentApplicants $stud) {
                        return $stud->users->last_name;
                    })
                    ->addColumn('course', function (StudentApplicants $stud) {
                        return $stud->courses->course_code;
                    })
                    ->addColumn('image', function ($data) {
                        $url = asset('uploads/' . $data->image);
                        return '<img src="' . $url . '" class="img-thumbnail img-circle"
                                width="50" alt="Image">';
                    })
                    ->addColumn('status', function (StudentApplicants $data) {
                        if ($data->status == '1') {
                            return '<span class="badge badge-success">Approved</span>';
                        } else if ($data->status == '2') {
                            return '<span class="badge badge-danger">Rejected</span>';
                        } else {
                            return '<span class="badge badge-warning">Pending</span>';
                        }
                    })
                    ->addColumn('action', function ($data) {
                        return view('admin.presidents-list-award.action.buttons', compact('data'));
                    })
                    ->rawColumns(['image', 'status', 'action'])
                    ->make(true);
            }
        }
        return view('admin.presidents-list-award.overall');
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
}
