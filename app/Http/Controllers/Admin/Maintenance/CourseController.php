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
        $this->middleware('permission:program list', ['only' => ['index', 'edit', 'create']]);
        $this->middleware('permission:program create', ['only' => ['create', 'store']]);
        $this->middleware('permission:program edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:program delete', ['only' => ['destroy', 'deleteAll']]);
    }

    public function index()
    {
        $programs = Courses::all();
        return view('admin.maintenance.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.maintenance.programs.create');
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

        return redirect('admin/maintenance/programs/create')->with('success', 'Program added successfully');
    }

    public function edit($id)
    {
        $program = Courses::find($id);
        return view('admin.maintenance.programs.edit', compact('program'));
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

        return redirect('admin/maintenance/programs')->with('success', 'Program updated successfully');
    }

    public function destroy(Request $request)
    {
        $course = Courses::find($request->course_delete_id);
        $course->delete();
        return redirect()->back()->with('success', 'Program deleted successfully');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Courses::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'Program deleted successfully'
        ]);
    }
}
