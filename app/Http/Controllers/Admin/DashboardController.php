<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicAward;
use App\Models\AcademicExcellence;
use App\Models\Courses;
use App\Models\StudentApplicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

class DashboardController extends Controller
{

    public function index()
    {
        //analytics
        $analytics_achiever = StudentApplicant::where('award_applied', '1')->count();
        $analytics_deans = StudentApplicant::where('award_applied', '2')->count();
        $analytics_presidents = StudentApplicant::where('award_applied', '3')->count();
        $analytics_acadexcell = AcademicExcellence::where('award_applied', '4')->count();

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
        $total_achiever = StudentApplicant::where('award_applied', '1')->where('status', '1')->count();

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

        $total_dean = StudentApplicant::where('award_applied', '2')->where('status', '1')->count();

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

        $total_president = StudentApplicant::where('award_applied', '3')->where('status', '1')->count();

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

        $total_excellence = AcademicExcellence::where('award_applied', '4')->where('status', '1')->count();

        return view('admin.dashboard', compact('analytics_achiever', 'analytics_deans', 'analytics_presidents', 'analytics_acadexcell', 'achiever', 'total_achiever', 'deans', 'total_dean', 'president', 'total_president', 'excellence', 'total_excellence'));
    }
}
