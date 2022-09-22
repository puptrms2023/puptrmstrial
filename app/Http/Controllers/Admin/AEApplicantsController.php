<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use App\Models\AeApplicant;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

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
            $data = AeApplicant::with('users')->with('courses')->where('ae_applicants.course_id', $courses->id)->select('ae_applicants.*');
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
    public function approved($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $approve = AeApplicant::where('course_id', $courses->id)->get();
        $approve = AeApplicant::find($id);
        $approve->status = 1;
        $approve->save();
        return redirect()->back();
    }
    public function rejected($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $reject = AeApplicant::where('course_id', $courses->id)->get();
        $reject = AeApplicant::find($id);
        $reject->status = 2;
        $reject->save();
        return redirect()->back();
    }
    public function openPdfApproved($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = AeApplicant::where('course_id', $courses->id)
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
        $students = AeApplicant::where('course_id', $courses->id)
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
        $students = AeApplicant::where('course_id', $courses->id)
            ->orderBy('year_level', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.academic-excellence-award.student-list', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Academic-Excellence-Awardee-Applicants-' . $courses->course_code . '.pdf');
    }
}
