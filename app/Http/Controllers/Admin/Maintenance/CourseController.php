<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu module', ['only' => ['index', 'create', 'edit', 'update', 'destroy', 'deleteAll']]);
        $this->middleware('permission:course list', ['only' => ['index', 'edit', 'create']]);
        $this->middleware('permission:course create', ['only' => ['create', 'store']]);
        $this->middleware('permission:course edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:course delete', ['only' => ['destroy', 'deleteAll']]);
    }

    public function index()
    {
        $programs = Courses::all();
        return view('admin.maintenance.courses.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.maintenance.courses.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'program_code' => 'required|unique:courses,course_code',
            'program' => 'required|unique:courses,course'
        ]);

        $course = new Courses;
        $course->course_code = $request->program_code;
        $course->course = $request->program;
        $course->save();

        return redirect('admin/maintenance/programs')->with('success', 'Course added successfully');
    }

    public function edit($id)
    {
        $program = Courses::find($id);
        return view('admin.maintenance.courses.edit', compact('program'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'program_code' => 'required|unique:courses,course_code,' . $id,
            'program' => 'required|unique:courses,course,' . $id,
        ]);

        $course = Courses::find($id);
        $course->course_code = $request->program_code;
        $course->course = $request->program;
        $course->save();

        return redirect('admin/maintenance/programs')->with('success', 'Course updated successfully');
    }

    public function destroy(Request $request)
    {
        $course = Courses::find($request->course_delete_id);
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Courses::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'Course deleted successfully'
        ]);
    }
}
