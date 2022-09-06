<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\StudentApplicants;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApplicationStatusController extends Controller
{
    public function index()
    {
        $status = StudentApplicants::where('user_id', Auth::id())->get();
        return view('user.application-status.index', compact('status'));
    }
}
