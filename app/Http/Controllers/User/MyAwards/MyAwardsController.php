<?php

namespace App\Http\Controllers\User\MyAwards;

use App\Models\MyAward;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyAwardsController extends Controller
{
    public function index()
    {
        $awards = MyAward::where('user_id', Auth::id())->get();
        return view('user.myawards.index', compact('awards'));
    }
}
