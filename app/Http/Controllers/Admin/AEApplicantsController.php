<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AEApplicantsController extends Controller
{
    public function index()
    {
        $courses = Courses::all();
        return view('admin.academic-excellence-award.index', compact('courses'));
    }
}
