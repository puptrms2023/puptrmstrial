<?php

namespace App\Http\Controllers\User\Calendar;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FullCalendarController extends Controller
{
    public function index()
    {
        $events = [];

        $calendar = Event::get();

        foreach ($calendar as $data) {

            $events[] = [
                'title' => $data->title,
                'start' => $data->start,
                'end' => $data->end,
                'url'   => url('user/calendar', $data->id),
            ];
        }

        return view('user.calendar.index', compact('events'));
    }

    public function show($id)
    {
        $events = Event::findOrFail($id);
        return view('user.calendar.view', compact('events'));
    }
}
