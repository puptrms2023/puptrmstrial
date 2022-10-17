<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;

class DashboardController extends Controller
{
    public function index()
    {
        $acadexcel = Form::where('award_form', 'Academic Excellence')->first();
        $nonacad = Form::where('award_form', 'Non Academic')->first();
        $acadaward = Form::where('award_form', 'Academic Award')->first();
        // dd($acadexcel);
        return view('user.dashboard', compact('acadexcel', 'acadaward', 'nonacad'));
    }
}
