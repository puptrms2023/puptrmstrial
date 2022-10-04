<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AcademicExcellence;
use App\Models\StudentApplicant;
use Illuminate\Support\Facades\Auth;

class ApplicationStatusController extends Controller
{
    public function aaAward()
    {
        $status = StudentApplicant::where('user_id', Auth::id())->get();
        return view('user.application-status.academic-award', compact('status'));
    }
    public function aeAward()
    {
        $status = AcademicExcellence::where('user_id', Auth::id())->get();
        return view('user.application-status.academic-excellence', compact('status'));
    }
}
