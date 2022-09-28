<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use App\Models\Summary;
use Illuminate\Http\Request;
use App\Models\AcademicExcellence;
use App\Http\Controllers\Controller;
use App\Models\SummaryAcadExcell;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class AEApplicantsController extends Controller
{
    public function index()
    {
        $pending = AcademicExcellence::where('status', '0')->count();
        $courses = Courses::all();
        return view('admin.academic-excellence-award.index', compact('courses', 'pending'));
    }
    public function achieversView(Request $request, $course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $model = AcademicExcellence::with('users')->with('courses')->where('ae_applicants.course_id', $courses->id)->select('ae_applicants.*');
        if ($request->ajax()) {
            if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                $model->where('status', $request->get('status'))->get();
            }
            return DataTables::eloquent($model)
                ->addColumn('studno', function (AcademicExcellence $stud) {
                    return $stud->users->stud_num;
                })
                ->addColumn('fname', function (AcademicExcellence $stud) {
                    return $stud->users->first_name;
                })
                ->addColumn('lname', function (AcademicExcellence $stud) {
                    return $stud->users->last_name;
                })
                ->addColumn('course', function (AcademicExcellence $stud) {
                    return $stud->courses->course_code;
                })
                ->addColumn('image', function ($data) {
                    $url = asset('uploads/' . $data->image);
                    return '<img src="' . $url . '" class="img-thumbnail img-circle"
                                    width="50" alt="Image">';
                })
                ->addColumn('status', function (AcademicExcellence $data) {
                    if ($data->status == '1') {
                        return '<span class="badge badge-success">Approved</span>';
                    } else if ($data->status == '2') {
                        return '<span class="badge badge-danger">Rejected</span>';
                    } else {
                        return '<a href="/admin/academic-excellence-award/' . $data->courses->course_code . '/approve/' . $data->id . '" class="btn btn-success btn-sm btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Approve</span>
                    </a>
                    <a href="/admin/academic-excellence-award/' . $data->courses->course_code . '/reject/' . $data->id . '" class="btn btn-danger btn-sm btn-icon-split" >
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
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.academic-excellence-award.view', compact('courses'));
    }

    public function studentApplicationView($course_code, $id)
    {
        $status = AcademicExcellence::where('id', $id)->first();
        $grades = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "1")
            ->get();
        $grades2 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "2")
            ->get();
        $grades3 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "3")
            ->get();
        $grades4 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "4")
            ->get();
        $grades5 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "5")
            ->get();
        $grades6 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "6")
            ->get();
        $grades7 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "7")
            ->get();
        $grades8 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "8")
            ->get();

        return view('admin.academic-excellence-award.student', compact('status', 'grades', 'grades2', 'grades3', 'grades4', 'grades5', 'grades6', 'grades7', 'grades8'));
    }

    public function approved($course_code, $id)
    {
        $approve = AcademicExcellence::find($id);
        $approve->status = 1;
        $approve->save();
        return redirect()->back();
    }

    public function rejected($course_code, $id)
    {
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

    public function overallList(Request $request)
    {
        $model = AcademicExcellence::with('users', 'courses')->select('ae_applicants.*');
        if ($request->ajax()) {
            if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                $model->where('status', $request->get('status'))->get();
            }
            return DataTables::eloquent($model)
                ->addColumn('studno', function (AcademicExcellence $stud) {
                    return $stud->users->stud_num;
                })
                ->addColumn('fname', function (AcademicExcellence $stud) {
                    return $stud->users->first_name;
                })
                ->addColumn('lname', function (AcademicExcellence $stud) {
                    return $stud->users->last_name;
                })
                ->addColumn('course', function (AcademicExcellence $stud) {
                    return $stud->courses->course_code;
                })
                ->addColumn('image', function ($data) {
                    $url = asset('uploads/' . $data->image);
                    return '<img src="' . $url . '" class="img-thumbnail img-circle"
                                width="50" alt="Image">';
                })
                ->addColumn('status', function (AcademicExcellence $data) {
                    if ($data->status == '1') {
                        return '<span class="badge badge-success">Approved</span>';
                    } else if ($data->status == '2') {
                        return '<span class="badge badge-danger">Rejected</span>';
                    } else {
                        return '<span class="badge badge-warning">Pending</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '';
                    $btn .= '<a href="/admin/academic-excellence-award/' . $data->courses->course_code . '/' . $data->id . '" class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i> </a> ';
                    $btn .= '<a href="javascript:void(0)" data-toggle="tooltip" class="btn btn-sm btn-danger deleteFormbtn" data-id="' . $data->id . '"><i class="fa fa-trash"></i> </button>';

                    return $btn;
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.academic-excellence-award.overall');
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
