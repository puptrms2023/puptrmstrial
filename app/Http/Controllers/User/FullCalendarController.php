<?php

namespace App\Http\Controllers\User;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Event::all();

            return response()->json($data);
        }
        return view('user.calendar.index');
    }
}
