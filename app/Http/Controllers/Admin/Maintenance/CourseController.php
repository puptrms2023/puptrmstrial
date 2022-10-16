<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $course = Courses::all();
        return view('admin.maintenance.courses.index', compact('course'));
    }

    public function create()
    {
        return view('admin.maintenance.courses.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'course_code' => 'required',
            'course' => 'required'
        ]);

        $course = new Courses;
        $course->course_code = $request->course_code;
        $course->course = $request->course;
        $course->save();

        return redirect('admin/maintenance/courses')->with('success', 'Course added successfully');
    }

    public function edit($id)
    {
        $course = Courses::find($id);
        return view('admin.maintenance.courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'course_code' => 'required',
            'course' => 'required'
        ]);

        $course = Courses::find($id);
        $course->course_code = $request->course_code;
        $course->course = $request->course;
        $course->save();

        return redirect('admin/maintenance/courses')->with('success', 'Course updated successfully');
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
