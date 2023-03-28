<?php

namespace App\Http\Controllers\Admin\Applicant;

use App\Models\User;
use App\Models\Reason;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SummaryAcadExcell;
use App\Models\AcademicExcellence;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StudentApplicantStatus;

class AEApplicantsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu academic awards', ['only' => ['index', 'achieversView', 'approved', 'rejected', 'studentApplicationView', 'update', 'openPdfApproved', 'openPdfRejected', 'openPdfAll', 'overallList']]);
        $this->middleware('permission:acad excellence list', ['only' => ['index', 'achieversView', 'approved', 'rejected', 'studentApplicationView', 'update', 'openPdfApproved', 'openPdfRejected', 'openPdfAll', 'overallList']]);
        $this->middleware('permission:acad excellence edit', ['only' => ['update', 'approved', 'rejected']]);
        $this->middleware('permission:acad excellence delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $courses = Courses::withCount(['ae_applicants as applicant_count' => function ($query) {
            $query->where('status', 0)
                ->where('school_year', getAcademicYear());
        }])
            ->get();
        return view('admin.academic-excellence-award.index', compact('courses'));
    }
    public function achieversView(Request $request, $course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $model = AcademicExcellence::with('users')->with('courses')->where('ae_applicants.course_id', $courses->id)->where('school_year', getAcademicYear())->select('ae_applicants.*');
        if ($request->ajax()) {
            if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                $model->where('status', $request->get('status'))->get();
            }

            if ($request->get('year') == '4th-Year' || $request->get('year') == '5th-Year') {
                $year = str_replace('-', ' ', $request->get('year'));
                $model->where('year_level', $year)->get();
            }

            return DataTables::eloquent($model)
                ->addColumn('checkbox', function (AcademicExcellence $stud) {
                    return '<input type="checkbox" name="form_checkbox" data-id="' . $stud['id'] . '">';
                })
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
                ->addColumn('avg', function (AcademicExcellence $stud) {
                    $totalwithSummer = ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa9) / 9;
                    $totalwith5thYear = ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa10 + $stud->gwa11) / 10;
                    $totalwith5thAndSummer = ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa9 + $stud->gwa10 + $stud->gwa11) / 11;
                    if (!empty($stud->gwa9) && empty($stud->gwa10)) {
                        return number_format((float) $totalwithSummer, 3, '.', '');
                    } else if (!empty($stud->gwa10 || $stud->gwa11) && empty($stud->gwa9)) {
                        return number_format((float) $totalwith5thYear, 3, '.', '');
                    } else if (!empty($stud->gwa9 && $stud->gwa10)) {
                        return number_format((float) $totalwith5thAndSummer, 3, '.', '');
                    } else {
                        return $stud->gwa;
                    }
                })
                ->addColumn('status', function (AcademicExcellence $data) {
                    return view('admin.academic-excellence-award.action.status', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.academic-excellence-award.action.buttons', compact('data'));
                })
                ->rawColumns(['checkbox', 'image', 'avg', 'status', 'action'])
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
        $grades9 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "9")
            ->get();
        $grades10 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "10")
            ->get();
        $grades11 = SummaryAcadExcell::where('app_id', $id)
            ->where('term', "11")
            ->get();
        $totalwithSummer = ($status->gwa1 + $status->gwa2 + $status->gwa3 + $status->gwa4 + $status->gwa5 + $status->gwa6 + $status->gwa7 + $status->gwa8 + $status->gwa9) / 9;
        $totalwith5thYear = ($status->gwa1 + $status->gwa2 + $status->gwa3 + $status->gwa4 + $status->gwa5 + $status->gwa6 + $status->gwa7 + $status->gwa8 + $status->gwa10 + $status->gwa11) / 10;
        $totalwith5thAndSummer = ($status->gwa1 + $status->gwa2 + $status->gwa3 + $status->gwa4 + $status->gwa5 + $status->gwa6 + $status->gwa7 + $status->gwa8 + $status->gwa9 + $status->gwa10 + $status->gwa11) / 11;
        $reasons = Reason::pluck('description', 'id');

        return view('admin.academic-excellence-award.student', compact('status', 'grades', 'grades2', 'grades3', 'grades4', 'grades5', 'grades6', 'grades7', 'grades8', 'grades9', 'grades10', 'grades11', 'totalwithSummer', 'totalwith5thYear', 'totalwith5thAndSummer', 'reasons'));
    }

    public function approved($course_code, $id)
    {
        $approve = AcademicExcellence::find($id);
        $users = User::where('id', $approve->user_id)->get();
        $award = $approve->award->acad_code;
        $approve->status = 1;

        $approve->save();

        Notification::send($users, new StudentApplicantStatus($approve->id, $approve->status, $award));
        return redirect()->back();
    }

    public function rejected($course_code, $id)
    {
        $reject = AcademicExcellence::find($id);
        $users = User::where('id', $reject->user_id)->get();
        $award = $reject->award->acad_code;
        $reject->status = 2;

        $reject->save();

        Notification::send($users, new StudentApplicantStatus($reject->id, $reject->status, $award));
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
        $status->others = $request->others;
        $award = $status->award->acad_code;

        $users = User::where('id', $status->user_id)->get();
        $status->save();
        if ($request->status == '1' || $request->status == '2') {
            Notification::send($users, new StudentApplicantStatus($status->id, $request->status, $award));
        }
        return redirect()->back()->with('success', 'The Application form updated successfully');
    }

    public function openPdfApproved($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $students = AcademicExcellence::where('course_id', $courses->id)
            ->where('status', '1')
            ->where('school_year', getAcademicYear())
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
            ->where('school_year', getAcademicYear())
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
            ->where('school_year', getAcademicYear())
            ->orderBy('year_level', 'asc')
            ->get();
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.academic-excellence-award.student-list', array('students' => $students), array('courses' => $courses));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Academic-Excellence-Awardee-Applicants-' . $courses->course_code . '.pdf');
    }

    public function overallList(Request $request)
    {
        $model = AcademicExcellence::with('users', 'courses')->where('school_year', getAcademicYear())->select('ae_applicants.*');
        if ($request->ajax()) {
            if ($request->get('status') == '0' || $request->get('status') == '1' || $request->get('status') == '2') {
                $model->where('status', $request->get('status'))->get();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function (AcademicExcellence $stud) {
                    return '<input type="checkbox" name="form_checkbox" data-id="' . $stud['id'] . '">';
                })
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
                ->addColumn('avg', function (AcademicExcellence $stud) {
                    $totalwithSummer = ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa9) / 9;
                    $totalwith5thYear = ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa10 + $stud->gwa11) / 10;
                    $totalwith5thAndSummer = ($stud->gwa1 + $stud->gwa2 + $stud->gwa3 + $stud->gwa4 + $stud->gwa5 + $stud->gwa6 + $stud->gwa7 + $stud->gwa8 + $stud->gwa9 + $stud->gwa10 + $stud->gwa11) / 11;
                    if (!empty($stud->gwa9) && empty($stud->gwa10)) {
                        return number_format((float) $totalwithSummer, 3, '.', '');
                    } else if (!empty($stud->gwa10 || $stud->gwa11) && empty($stud->gwa9)) {
                        return number_format((float) $totalwith5thYear, 3, '.', '');
                    } else if (!empty($stud->gwa9 && $stud->gwa10)) {
                        return number_format((float) $totalwith5thAndSummer, 3, '.', '');
                    } else {
                        return $stud->gwa;
                    }
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
                    return view('admin.academic-excellence-award.action.buttons', compact('data'));
                })
                ->rawColumns(['checkbox', 'image', 'avg', 'status', 'action'])
                ->make(true);
        }

        return view('admin.academic-excellence-award.overall');
    }

    public function destroy(Request $request)
    {
        $form = AcademicExcellence::find($request->form_delete_id);
        $form->delete();
        return redirect()->back()->with('success', 'The Application form move to archive successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        AcademicExcellence::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'success' => 'The Application form move to archive successfully'
        ]);
    }

    public function getModalContent(Request $request, $id)
    {
        $term = $request->input('id');
        $grades = SummaryAcadExcell::where('app_id', $id)
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
            $grade = SummaryAcadExcell::where('id', $row_id)->first();

            // Update the record with the new grades and units
            $grade->grades = $grades[$i];
            $grade->units = $units[$i];
            $grade->save();

            $total_grades += $grades[$i] * $units[$i];
            $total_units += $units[$i];
        }

        $gwa = $total_units > 0 ? number_format($total_grades / $total_units, 2, '.', '') : 0;

        $app = AcademicExcellence::find($id);
        if ($request->term == '1') {
            $app->gwa1 = $gwa;
        } else if ($request->term == '2') {
            $app->gwa2 = $gwa;
        } else if ($request->term == '3') {
            $app->gwa3 = $gwa;
        } else if ($request->term == '4') {
            $app->gwa4 = $gwa;
        } else if ($request->term == '5') {
            $app->gwa5 = $gwa;
        } else if ($request->term == '6') {
            $app->gwa6 = $gwa;
        } else if ($request->term == '7') {
            $app->gwa7 = $gwa;
        } else if ($request->term == '8') {
            $app->gwa8 = $gwa;
        } else if ($request->term == '9') {
            $app->gwa9 = $gwa;
        } else if ($request->term == '10') {
            $app->gwa10 = $gwa;
        } else if ($request->term == '11') {
            $app->gwa11 = $gwa;
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

        $status = AcademicExcellence::findOrFail($id);

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
