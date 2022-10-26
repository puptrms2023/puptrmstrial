<?php

namespace App\Http\Controllers\User\About;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('user.about.index', compact('about'));
    }
}
