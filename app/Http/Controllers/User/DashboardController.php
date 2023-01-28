<?php

namespace App\Http\Controllers\User;

use App\Models\Form;
use App\Models\StudentApplicant;
use App\Http\Controllers\Controller;
use App\Models\AcademicExcellence;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $acadexcel = Form::with('requirement')->where('award_form', 'Academic Excellence')->first();
        $nonacad = Form::with('requirement')->where('award_form', 'Non Academic')->first();
        $acadaward = Form::with('requirement')->where('award_form', 'Academic Award')->first();
        $deans = Form::with('requirement')->where('award_form', 'Dean\'s List')->first();
        $presidents = Form::with('requirement')->where('award_form', 'President\'s List')->first();

        $acad_award_count = StudentApplicant::where('user_id', Auth::id())->where('school_year', getAcademicYear())->count();
        $acad_excell_award_count = AcademicExcellence::where('user_id', Auth::id())->where('school_year', getAcademicYear())->count();
        // dd($acad_award_count);

        return view('user.dashboard', compact('acadexcel', 'acadaward', 'nonacad', 'deans', 'presidents', 'acad_award_count', 'acad_excell_award_count'));
    }
}
