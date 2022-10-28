<?php

namespace App\Http\Controllers\User;

use App\Models\Form;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $acadexcel = Form::where('award_form', 'Academic Excellence')->first();
        $nonacad = Form::where('award_form', 'Non Academic')->first();
        $acadaward = Form::where('award_form', 'Academic Award')->first();

        return view('user.dashboard', compact('acadexcel', 'acadaward', 'nonacad'));
    }
}
