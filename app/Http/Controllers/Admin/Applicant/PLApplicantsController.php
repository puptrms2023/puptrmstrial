<?php

namespace App\Http\Controllers\Admin\Applicant;

use App\Models\User;
use App\Models\Reason;
use App\Models\Courses;
use App\Models\Summary;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\StudentApplicant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StudentApplicantStatus;

class PLApplicantsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu academic awards', ['only' => ['index', 'achieversView', 'approved', 'rejected', 'studentApplicationView', 'update', 'openPdfApproved', 'openPdfRejected', 'openPdfAll', 'overallList']]);
        $this->middleware('permission:presidents list list', ['only' => ['index', 'achieversView', 'approved', 'rejected', 'studentApplicationView', 'update', 'openPdfApproved', 'openPdfRejected', 'openPdfAll', 'overallList']]);
        $this->middleware('permission:presidents list edit', ['only' => ['update', 'approved', 'rejected']]);
        $this->middleware('permission:presidents list delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $courses = Courses::withCount(['applicants as applicant_count' => function ($query) {
            $query->where('award_applied', 3)
                ->where('status', 0)
                ->where('school_year', getAcademicYear());
        }])
            ->get();
        return view('admin.presidents-list-award.index', compact('courses'));
    }

    public function achieversView(Request $request, $course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $model = StudentApplicant::with('users', 'courses')
            ->where('student_applicants.course_id', $courses->id)
            ->where('award_applied', '3')
            ->where('school_year', getAcademicYear())
            ->select('student_applicants.*');

        if ($request->ajax()) {
            if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                $model->where('status', $request->get('status'))->get();
            }

            if ($request->get('year') == '2nd-Year' || $request->get('year') == '3rd-Year' || $request->get('year') == '4th-Year' || $request->get('year') == '5th-Year') {
                $year = str_replace('-', ' ', $request->get('year'));
                $model->where('year_level', $year)->get();
            }

            return DataTables::eloquent($model)
                ->addColumn('checkbox', function (StudentApplicant $stud) {
                    return '<input type="checkbox" name="form_checkbox" data-id="' . $stud['id'] . '">';
                })
                ->addColumn('studno', function (StudentApplicant $stud) {
                    return $stud->users->stud_num;
                })
                ->addColumn('fname', function (StudentApplicant $stud) {
                    return $stud->users->first_name;
                })
                ->addColumn('lname', function (StudentApplicant $stud) {
                    return $stud->users->last_name;
                })
                ->addColumn('course', function (StudentApplicant $stud) {
                    return $stud->courses->course_code;
                })
                ->addColumn('image', function ($data) {
                    $url = asset('uploads/' . $data->image);
                    return '<img src="' . $url . '" class="img-thumbnail img-circle"
                                    width="50" alt="Image">';
                })
                ->addColumn('status', function (StudentApplicant $data) {
                    return view('admin.presidents-list-award.action.status', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.presidents-list-award.action.buttons', compact('data'));
                })
                ->rawColumns(['checkbox', 'image', 'status', 'action'])
                ->make(true);
        }

        return view('admin.presidents-list-award.view', compact('courses'));
    }

    public function approved($course_code, $id)
    {
        $approve = StudentApplicant::find($id);
        $users = User::where('id', $approve->user_id)->get();
        $award = $approve->award->acad_code;
        $approve->status = 1;

        $approve->save();

        Notification::send($users, new StudentApplicantStatus($approve->id, $approve->status, $award));
        return redirect()->back();
    }
    public function rejected($course_code, $id)
    {
        $reject = StudentApplicant::find($id);
        $users = User::where('id', $reject->user_id)->get();
        $award = $reject->award->acad_code;
        $reject->status = 2;

        $reject->save();

        Notification::send($users, new StudentApplicantStatus($reject->id, $reject->status, $award));
        return redirect()->back();
    }

    public function studentApplicationView($course_code, $id)
    {
        $status = StudentApplicant::with('users')->where('id', $id)->first();
        $grades = Summary::where('app_id', $id)
            ->where('term', "1")
            ->get();
        $grades2 = Summary::where('app_id', $id)
            ->where('term', "2")
            ->get();
        $reasons = Reason::pluck('description', 'id');
        return view('admin.presidents-list-award.student', compact('status', 'grades', 'grades2', 'reasons'));
    }

    public function update(Request $request, $course_code, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'reason' => 'nullable'
        ]);

        $status = StudentApplicant::findOrFail($id);

        $status->status = $request->status;
        $status->reason = $request->reason;
        $status->others = $request->others;
        $award = $status->award->acad_code;

        $users = User::where('id', $status->user_id)->get();
        $status->save();
        if ($request->status == '1' || $request->status == '2') {
            Notification::send($users, new StudentApplicantStatus($status->id, $request->status, $award));
        }
        return redirect()->back()->with('success', 'The Application form updated successfully');
    }

    public function openPdfApproved($course_code, $year_level)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        if ($year_level == "All") {
            $students = StudentApplicant::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('status', '1')
                ->where('school_year', getAcademicYear())
                ->orderBy('gwa', 'asc')
                ->get();
        } else {
            $year = str_replace('-', ' ', $year_level);
            $courses = Courses::where('course_code', $course_code)->first();
            $students = StudentApplicant::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('year_level', $year)
                ->where('status', '1')
                ->where('school_year', getAcademicYear())
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
            $students = StudentApplicant::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('status', '2')
                ->where('school_year', getAcademicYear())
                ->orderBy('gwa', 'asc')
                ->get();
        } else {
            $year = str_replace('-', ' ', $year_level);
            $courses = Courses::where('course_code', $course_code)->first();
            $students = StudentApplicant::where('award_applied', '3')
                ->where('course_id', $courses->id)
                ->where('year_level', $year)
                ->where('status', '2')
                ->where('school_year', getAcademicYear())
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
        $students = StudentApplicant::where('award_applied', '3')
            ->where('course_id', $courses->id)
            ->where('school_year', getAcademicYear())
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
                $model = StudentApplicant::with('users', 'courses')->where('award_applied', '3')->where('school_year', getAcademicYear())->select('student_applicants.*');
                if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                    $model->where('status', $request->get('status'))->get();
                }
                return DataTables::eloquent($model)
                    ->addColumn('checkbox', function (StudentApplicant $stud) {
                        return '<input type="checkbox" name="form_checkbox" data-id="' . $stud['id'] . '">';
                    })
                    ->addColumn('studno', function (StudentApplicant $stud) {
                        return $stud->users->stud_num;
                    })
                    ->addColumn('fname', function (StudentApplicant $stud) {
                        return $stud->users->first_name;
                    })
                    ->addColumn('lname', function (StudentApplicant $stud) {
                        return $stud->users->last_name;
                    })
                    ->addColumn('course', function (StudentApplicant $stud) {
                        return $stud->courses->course_code;
                    })
                    ->addColumn('image', function ($data) {
                        $url = asset('uploads/' . $data->image);
                        return '<img src="' . $url . '" class="img-thumbnail img-circle"
                                width="50" alt="Image">';
                    })
                    ->addColumn('status', function (StudentApplicant $data) {
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
                    ->rawColumns(['checkbox', 'image', 'status', 'action'])
                    ->make(true);
            }
        }
        return view('admin.presidents-list-award.overall');
    }

    public function destroy(Request $request)
    {
        $form = StudentApplicant::find($request->form_delete_id);
        $form->delete();
        return redirect()->back()->with('success', 'The Application form move to archive successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        StudentApplicant::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'success' => 'The Application form move to archive successfully'
        ]);
    }

    public function getModalContent(Request $request, $id)
    {
        $term = $request->input('id');
        $grades = Summary::where('app_id', $id)
            ->where('term', $term)
            ->get();

        $html = "";
        if (!empty($grades)) {
            $html .= "<table class='table table-sm'>
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Description</th>
                    <th>Grade</th>
                    <th>Units</th>
                </tr>
            </thead>
            <tbody>";
            foreach ($grades as $grade) {
                $html .= "<tr data-id='$grade->id'>
                <td>" . $grade->subjects->s_code . "</td>
                <td>" . $grade->subjects->s_name . "</td>
                <td><input type='text' name='grades' class='form-control form-control-sm text-center grade-input' onkeyup='calculateGWA()' value='$grade->grades'></td>
                <td><input type='text' name='units' class='form-control form-control-sm text-center unit-input' onkeyup='calculateGWA()' value='$grade->units'></td>
            </tr>";
            }
            $html .= "<tr>
            <td colspan='3' class='text-right font-weight-bold'>GWA:</td>
            <td><input type='text' class='form-control form-control-sm text-center' id='gwa' readonly></td>
        </tr>";
            $html .= "</tbody>
        </table>";
            $html .= "<input type='hidden' id='term-table' value='$term'>";
        }

        $response['html'] = $html;

        return response()->json($response);
    }

    public function gradesUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'term' => 'required',
            'data.grades.*' => ['required', 'numeric', Rule::in([1.00, 1.25, 1.5, 1.75, 2.00, 2.25, 2.50, 2.75, 3.00])],
            'data.units.*' => 'required|numeric',
            'data.ids.*' => 'required|numeric',
        ]);

        // check if validation failed
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ]);
        }

        $grades = $request->input('data.grades');
        $units = $request->input('data.units');
        $ids = $request->input('data.ids');
        $total_grades = 0;
        $total_units = 0;
        // Loop through the grades and units and update the corresponding records
        for ($i = 0; $i < count($grades); $i++) {
            // Get the row ID from the request data
            $row_id = $ids[$i];

            // Find the corresponding record using the row ID
            $grade = Summary::where('id', $row_id)->first();

            // Update the record with the new grades and units
            $grade->grades = $grades[$i];
            $grade->units = $units[$i];
            $grade->save();

            $total_grades += $grades[$i] * $units[$i];
            $total_units += $units[$i];
        }

        $gwa = $total_units > 0 ? number_format($total_grades / $total_units, 2, '.', '') : 0;

        $app = StudentApplicant::find($id);
        if ($request->term == '1') {
            $app->gwa_1st = $gwa;
        } else {
            $app->gwa_2nd = $gwa;
        }
        $app->save();

        return response()->json([
            'success' => 'Grades updated successfully'
        ]);
    }

    public function updateImage(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg'
        ]);

        // check if validation failed
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ]);
        }

        $status = StudentApplicant::findOrFail($id);

        if ($request->hasfile('image')) {

            if ($status->image && file_exists(public_path('uploads/' . $status->image))) {
                unlink(public_path('uploads/' . $status->image));
            }
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/', $filename);
            $status->image = $filename;
        }

        $status->save();

        return response()->json([
            'success' => 'Image updated successfully'
        ]);
    }
}
