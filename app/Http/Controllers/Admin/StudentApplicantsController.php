<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\StudentApplicants;
use App\Models\Summary;
use Illuminate\Http\Request;

class StudentApplicantsController extends Controller
{
    public function index()
    {
        $courses = Courses::all();
        return view('admin.achievers-award.index', compact('courses'));
    }

    public function achieversView($course_code)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $status = StudentApplicants::where('course_id', $courses->id)->get();
        return view('admin.achievers-award.view', compact('courses', 'status'));
    }

    public function approved($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $approve = StudentApplicants::where('course_id', $courses->id)->get();
        $approve = StudentApplicants::find($id);
        $approve->status = 1;
        $approve->save();
        return redirect()->back();
    }
    public function rejected($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $reject = StudentApplicants::where('course_id', $courses->id)->get();
        $reject = StudentApplicants::find($id);
        $reject->status = 2;
        $reject->save();
        return redirect()->back();
    }

    public function studentApplicationView($course_code, $id)
    {
        $courses = Courses::where('course_code', $course_code)->first();
        $status = StudentApplicants::where('course_id', $courses->id)->get();
        $status = StudentApplicants::find($id);
        $grades = Summary::where('user_id', $status->user_id)->get();
        $grades = $grades->where('term', '=', "1");
        $grades2 = Summary::where('user_id', $status->user_id)->get();
        $grades2 = $grades2->where('term', '=', "2");
        return view('admin.achievers-award.student', compact('courses', 'status', 'grades', 'grades2'));
    }
}
