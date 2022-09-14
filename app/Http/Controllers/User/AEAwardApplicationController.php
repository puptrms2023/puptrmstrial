<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AEAwardApplicationController extends Controller
{
    public function index()
    {
        return view('user.application-form-ae.index');
    }
}
