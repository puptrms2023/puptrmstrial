<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courses;
use Illuminate\Http\Request;
use App\Models\StudentApplicant;
use App\Models\AcademicExcellence;
use App\Http\Controllers\Controller;
use App\Models\NonAcadAward;
use App\Models\NonAcademicApplicant;

class ArchiveController extends Controller
{
    public function archiveAA($course_code)
    {
        $course = Courses::where('course_code', $course_code)->first();
        $form = StudentApplicant::where('course_id', $course->id)->onlyTrashed()->get();
        return view('admin.achievers-award.archive', compact('form', 'course'));
    }
    public function allarchiveAA()
    {
        $form = StudentApplicant::where('award_applied', '1')->onlyTrashed()->get();
        return view('admin.achievers-award.archive-all', compact('form'));
    }

    public function archiveDL($course_code)
    {
        $course = Courses::where('course_code', $course_code)->first();
        $form = StudentApplicant::where('course_id', $course->id)->onlyTrashed()->get();
        return view('admin.deans-list-award.archive', compact('form', 'course'));
    }
    public function allarchiveDL()
    {
        $form = StudentApplicant::where('award_applied', '2')->onlyTrashed()->get();
        return view('admin.deans-list-award.archive-all', compact('form'));
    }

    public function archivePL($course_code)
    {
        $course = Courses::where('course_code', $course_code)->first();
        $form = StudentApplicant::where('course_id', $course->id)->onlyTrashed()->get();
        return view('admin.presidents-list-award.archive', compact('form', 'course'));
    }
    public function allarchivePL()
    {
        $form = StudentApplicant::where('award_applied', '3')->onlyTrashed()->get();
        return view('admin.presidents-list-award.archive-all', compact('form'));
    }

    public function archiveAE($course_code)
    {
        $course = Courses::where('course_code', $course_code)->first();
        $form = AcademicExcellence::where('course_id', $course->id)->onlyTrashed()->get();
        return view('admin.academic-excellence-award.archive', compact('form', 'course'));
    }

    public function allarchiveAE()
    {
        $form = AcademicExcellence::onlyTrashed()->get();
        return view('admin.academic-excellence-award.archive-all', compact('form'));
    }

    public function archiveNA($nonacad_id)
    {
        $nonacad = NonAcadAward::where('id', $nonacad_id)->first();
        $form = NonAcademicApplicant::where('nonacad_id', $nonacad->id)->onlyTrashed()->get();
        return view('admin.non-academic-award.archive', compact('form', 'nonacad'));
    }

    public function allarchiveNA()
    {
        $form = NonAcademicApplicant::onlyTrashed()->get();
        return view('admin.non-academic-award.archive-all', compact('form'));
    }


    public function restore($id)
    {
        StudentApplicant::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Record Restore successfully');
    }

    public function restore_all($course_code)
    {
        StudentApplicant::onlyTrashed()->restore();

        return redirect()->back()->with('success', 'All Records Restored successfully');
    }
    public function restoreAE($id)
    {
        AcademicExcellence::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Record Restore successfully');
    }

    public function restore_allAE($course_code)
    {
        AcademicExcellence::onlyTrashed()->restore();

        return redirect()->back()->with('success', 'All Records Restored successfully');
    }

    public function restoreNA($id)
    {
        NonAcademicApplicant::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Record Restore successfully');
    }

    public function restore_allNA($nonacad_id)
    {
        NonAcademicApplicant::onlyTrashed()->restore();

        return redirect()->back()->with('success', 'All Records Restored successfully');
    }
}
