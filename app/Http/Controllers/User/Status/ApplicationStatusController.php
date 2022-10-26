<?php

namespace App\Http\Controllers\User\Status;

use App\Models\StudentApplicant;
use App\Models\AcademicExcellence;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NonAcademicApplicant;
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
    public function naAward()
    {
        $status = NonAcademicApplicant::where('user_id', Auth::id())->get();
        return view('user.application-status.non-academic-award', compact('status'));
    }
}
