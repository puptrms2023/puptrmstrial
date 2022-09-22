<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\StudentApplicants;
use App\Http\Controllers\Controller;
use App\Models\AeApplicant;
use Illuminate\Support\Facades\Auth;

class ApplicationStatusController extends Controller
{
    public function aaAward()
    {
        $status = StudentApplicants::where('user_id', Auth::id())->get();
        return view('user.application-status.academic-award', compact('status'));
    }
    public function aeAward()
    {
        $status = AeApplicant::where('user_id', Auth::id())->get();
        return view('user.application-status.academic-excellence', compact('status'));
    }
}
