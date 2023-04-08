<?php

namespace App\Http\Controllers\Admin\ProgramSubject;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProgramSubjectFormRequest;
use App\Models\Courses;
use App\Models\ProgramSubject;
use App\Models\Subject;
use Illuminate\Http\Request;

class ProgramSubjectsController extends Controller
{
    public function index()
    {
        $programs = Courses::all();
        return view('admin.maintenance.program-subjects.index', compact('programs'));
    }

    public function view($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $sub = Subject::all();
        $fy_fs = ProgramSubject::where('program_id', $courses->id)->where('semester', 1)->where('year_level', 1)->get();
        $fy_ss = ProgramSubject::where('program_id', $courses->id)->where('semester', 2)->where('year_level', 1)->get();
        $sy_fs = ProgramSubject::where('program_id', $courses->id)->where('semester', 1)->where('year_level', 2)->get();
        $sy_ss = ProgramSubject::where('program_id', $courses->id)->where('semester', 2)->where('year_level', 2)->get();
        $ty_fs = ProgramSubject::where('program_id', $courses->id)->where('semester', 1)->where('year_level', 3)->get();
        $ty_ss = ProgramSubject::where('program_id', $courses->id)->where('semester', 2)->where('year_level', 3)->get();
        $foy_fs = ProgramSubject::where('program_id', $courses->id)->where('semester', 1)->where('year_level', 4)->get();
        $foy_ss = ProgramSubject::where('program_id', $courses->id)->where('semester', 2)->where('year_level', 4)->get();
        $fiy_fs = ProgramSubject::where('program_id', $courses->id)->where('semester', 1)->where('year_level', 5)->get();
        $fiy_ss = ProgramSubject::where('program_id', $courses->id)->where('semester', 2)->where('year_level', 5)->get();
        return view('admin.maintenance.program-subjects.view', compact('sub', 'courses', 'fy_fs', 'fy_ss', 'sy_fs', 'sy_ss', 'ty_fs', 'ty_ss', 'foy_fs', 'foy_ss', 'fiy_fs', 'fiy_ss'));
    }

    public function createUpdate(ProgramSubjectFormRequest $request, $program_id)
    {
        $data = $request->all();

        foreach ($request->fy_fs ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $fyfs = ProgramSubject::find($value['id']);
                $fyfs->subject_id = $value['subjects1'];
                $fyfs->units = $value['units1'];
                // Create
            } else {
                $fyfs = new ProgramSubject();
                $fyfs->program_id = $program_id;
                $fyfs->subject_id = $value['subjects1'];
                $fyfs->units = $value['units1'];
                $fyfs->year_level = $data['year_level'];
                $fyfs->semester = $data['semester1'];
            }
            $fyfs->save();
        }

        foreach ($request->fy_ss ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $fyss = ProgramSubject::find($value['id']);
                $fyss->subject_id = $value['subjects2'];
                $fyss->units = $value['units2'];
                // Create
            } else {
                $fyss = new ProgramSubject();
                $fyss->program_id = $program_id;
                $fyss->subject_id = $value['subjects2'];
                $fyss->units = $value['units2'];
                $fyss->year_level = $data['year_level'];
                $fyss->semester = $data['semester2'];
            }
            $fyss->save();
        }

        foreach ($request->sy_fs ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $syfs = ProgramSubject::find($value['id']);
                $syfs->subject_id = $value['subjects3'];
                $syfs->units = $value['units3'];
                // Create
            } else {
                $syfs = new ProgramSubject();
                $syfs->program_id = $program_id;
                $syfs->subject_id = $value['subjects3'];
                $syfs->units = $value['units3'];
                $syfs->year_level = $data['year_level2'];
                $syfs->semester = $data['semester3'];
            }
            $syfs->save();
        }

        foreach ($request->sy_ss ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $syss = ProgramSubject::find($value['id']);
                $syss->subject_id = $value['subjects4'];
                $syss->units = $value['units4'];
                // Create
            } else {
                $syss = new ProgramSubject();
                $syss->program_id = $program_id;
                $syss->subject_id = $value['subjects4'];
                $syss->units = $value['units4'];
                $syss->year_level = $data['year_level2'];
                $syss->semester = $data['semester4'];
            }
            $syss->save();
        }

        foreach ($request->ty_fs ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $tyfs = ProgramSubject::find($value['id']);
                $tyfs->subject_id = $value['subjects5'];
                $tyfs->units = $value['units5'];
                // Create
            } else {
                $tyfs = new ProgramSubject();
                $tyfs->program_id = $program_id;
                $tyfs->subject_id = $value['subjects5'];
                $tyfs->units = $value['units5'];
                $tyfs->year_level = $data['year_level3'];
                $tyfs->semester = $data['semester5'];
            }
            $tyfs->save();
        }

        foreach ($request->ty_ss ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $tyss = ProgramSubject::find($value['id']);
                $tyss->subject_id = $value['subjects6'];
                $tyss->units = $value['units6'];
                // Create
            } else {
                $tyss = new ProgramSubject();
                $tyss->program_id = $program_id;
                $tyss->subject_id = $value['subjects6'];
                $tyss->units = $value['units6'];
                $tyss->year_level = $data['year_level3'];
                $tyss->semester = $data['semester6'];
            }
            $tyss->save();
        }

        foreach ($request->foy_fs ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $foyfs = ProgramSubject::find($value['id']);
                $foyfs->subject_id = $value['subjects7'];
                $foyfs->units = $value['units7'];
                // Create
            } else {
                $foyfs = new ProgramSubject();
                $foyfs->program_id = $program_id;
                $foyfs->subject_id = $value['subjects7'];
                $foyfs->units = $value['units7'];
                $foyfs->year_level = $data['year_level4'];
                $foyfs->semester = $data['semester7'];
            }
            $foyfs->save();
        }

        foreach ($request->foy_ss ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $foyss = ProgramSubject::find($value['id']);
                $foyss->subject_id = $value['subjects8'];
                $foyss->units = $value['units8'];
                // Create
            } else {
                $foyss = new ProgramSubject();
                $foyss->program_id = $program_id;
                $foyss->subject_id = $value['subjects8'];
                $foyss->units = $value['units8'];
                $foyss->year_level = $data['year_level4'];
                $foyss->semester = $data['semester8'];
            }
            $foyss->save();
        }

        foreach ($request->fiy_fs ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $fiyfs = ProgramSubject::find($value['id']);
                $fiyfs->subject_id = $value['subjects9'];
                $fiyfs->units = $value['units9'];
                // Create
            } else {
                $fiyfs = new ProgramSubject();
                $fiyfs->program_id = $program_id;
                $fiyfs->subject_id = $value['subjects9'];
                $fiyfs->units = $value['units9'];
                $fiyfs->year_level = $data['year_level5'];
                $fiyfs->semester = $data['semester9'];
            }
            $fiyfs->save();
        }

        foreach ($request->fiy_ss ?? [] as $key => $value) {
            // Update
            if (isset($value['id']) && $value['id']) {
                $fiyss = ProgramSubject::find($value['id']);
                $fiyss->subject_id = $value['subjects10'];
                $fiyss->units = $value['units10'];
                // Create
            } else {
                $fiyss = new ProgramSubject();
                $fiyss->program_id = $program_id;
                $fiyss->subject_id = $value['subjects10'];
                $fiyss->units = $value['units10'];
                $fiyss->year_level = $data['year_level5'];
                $fiyss->semester = $data['semester10'];
            }
            $fiyss->save();
        }

        return redirect()->back()->with('success', 'Subjects added successfully');
    }

    public function destroy(Request $request)
    {
        $sub = ProgramSubject::find($request->sub_delete_id);
        $sub->delete();
        return redirect()->back()->with('success', 'Subject deleted successfully');
    }
}
