<?php

namespace App\Http\Controllers\User;

use App\Models\Form;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $acadexcel = Form::with('requirement')->where('award_form', 'Academic Excellence')->first();
        $nonacad = Form::with('requirement')->where('award_form', 'Non Academic')->first();
        $acadaward = Form::with('requirement')->where('award_form', 'Academic Award')->first();
        $deans = Form::with('requirement')->where('award_form', 'Dean\'s List')->first();
        $presidents = Form::with('requirement')->where('award_form', 'President\'s List')->first();

        return view('user.dashboard', compact('acadexcel', 'acadaward', 'nonacad', 'deans', 'presidents'));
    }
}
