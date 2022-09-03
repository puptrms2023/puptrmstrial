<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentApplicants;
use Illuminate\Http\Request;

class StudentApplicantsController extends Controller
{
    public function index()
    {
        $users = StudentApplicants::all();
        return view('admin.achievers-award.index', compact('users'));
    }
}
