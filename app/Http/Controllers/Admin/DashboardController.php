<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\AcademicAward;
use App\Models\StudentApplicant;
use App\Models\AcademicExcellence;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NonAcademicApplicant;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

class DashboardController extends Controller
{

    public function index()
    {
        //academic year
        $year = getAcademicYear();
        //analytics
        $analytics_achiever = StudentApplicant::where('award_applied', '1')->where('school_year', $year)->count();
        $analytics_deans = StudentApplicant::where('award_applied', '2')->where('school_year', $year)->count();
        $analytics_presidents = StudentApplicant::where('award_applied', '3')->where('school_year', $year)->count();
        $analytics_acadexcell = AcademicExcellence::where('award_applied', '4')->where('school_year', $year)->count();

        // Achiever's Award Drilldown
        $achiever = DB::table('courses')
            ->selectRaw('courses.course_code,COUNT(student_applicants.status) as total')
            ->leftJoin('student_applicants', function ($join) {
                $join->on('courses.id', '=', 'student_applicants.course_id')
                    ->where('student_applicants.status', '=', 1)
                    ->where('student_applicants.award_applied', '=', 1);
            })
            ->groupBy('courses.course_code')
            ->get()
            ->toArray();


        // $res = array_values($data);
        $total_achiever = StudentApplicant::where('award_applied', '1')->where('status', '1')->where('school_year', $year)->count();

        // Dean's Lister Drilldown
        $deans = DB::table('courses')
            ->selectRaw('courses.course_code,COUNT(student_applicants.status) as total')
            ->leftJoin('student_applicants', function ($join) {
                $join->on('courses.id', '=', 'student_applicants.course_id')
                    ->where('student_applicants.status', '=', 1)
                    ->where('student_applicants.award_applied', '=', 2);
            })
            ->groupBy('courses.course_code')
            ->get()
            ->toArray();

        $total_dean = StudentApplicant::where('award_applied', '2')->where('status', '1')->where('school_year', $year)->count();

        // President's Lister Drilldown
        $president = DB::table('courses')
            ->selectRaw('courses.course_code,COUNT(student_applicants.status) as total')
            ->leftJoin('student_applicants', function ($join) {
                $join->on('courses.id', '=', 'student_applicants.course_id')
                    ->where('student_applicants.status', '=', 1)
                    ->where('student_applicants.award_applied', '=', 3);
            })
            ->groupBy('courses.course_code')
            ->get()
            ->toArray();

        $total_president = StudentApplicant::where('award_applied', '3')->where('status', '1')->where('school_year', $year)->count();

        // President's Lister Drilldown
        $excellence = DB::table('courses')
            ->selectRaw('courses.course_code,COUNT(ae_applicants.status) as total')
            ->leftJoin('ae_applicants', function ($join) {
                $join->on('courses.id', '=', 'ae_applicants.course_id')
                    ->where('ae_applicants.status', '=', 1)
                    ->where('ae_applicants.award_applied', '=', 4);
            })
            ->groupBy('courses.course_code')
            ->get()
            ->toArray();

        $total_excellence = AcademicExcellence::where('award_applied', '4')->where('status', '1')->where('school_year', $year)->count();

        //total non academic
        $total_nonacad = NonAcademicApplicant::where('school_year', $year)->count();

        //pending
        $stud_applicant_p = StudentApplicant::where('status', '0')->count();
        $acad_excellence_p = AcademicExcellence::where('status', '0')->count();
        $nonacad_applicants_p = NonAcademicApplicant::where('status', '0')->count();
        $pending = $stud_applicant_p + $acad_excellence_p + $nonacad_applicants_p;

        //completed
        $stud_applicant_c = StudentApplicant::where('status', '1')->count();
        $acad_excellence_c = AcademicExcellence::where('status', '1')->count();
        $nonacad_applicants_c = NonAcademicApplicant::where('status', '1')->count();
        $completed = $stud_applicant_c + $acad_excellence_c + $nonacad_applicants_c;

        //rejected
        $stud_applicant_d = StudentApplicant::where('status', '2')->count();
        $acad_excellence_d = AcademicExcellence::where('status', '2')->count();
        $nonacad_applicants_d = NonAcademicApplicant::where('status', '2')->count();
        $rejected = $stud_applicant_d + $acad_excellence_d + $nonacad_applicants_d;

        return view('admin.dashboard', compact('year', 'total_nonacad', 'analytics_achiever', 'analytics_deans', 'analytics_presidents', 'analytics_acadexcell', 'achiever', 'total_achiever', 'deans', 'total_dean', 'president', 'total_president', 'excellence', 'total_excellence', 'pending', 'completed', 'rejected'));
    }
}
