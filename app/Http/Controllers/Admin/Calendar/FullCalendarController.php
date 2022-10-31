<?php

namespace App\Http\Controllers\Admin\Calendar;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDeleteRequest;
use Carbon\Carbon;

class FullCalendarController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:menu calendar', ['only' => ['index', 'create', 'edit', 'calendar']]);
        $this->middleware('permission:events list', ['only' => ['index', 'create', 'edit']]);
        $this->middleware('permission:events create', ['only' => ['create', 'store']]);
        $this->middleware('permission:events edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:events delete', ['only' => ['destroy', 'deleteAll']]);
        $this->middleware('permission:calendar show', ['only' => ['calendar']]);
    }

    public function index()
    {
        $events = Event::orderBy('id', 'desc')->get();
        return view('admin.calendar-events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.calendar-events.create');
    }

    public function store(EventRequest $request)
    {
        $validatedData = $request->validated();
        $data = new Event;
        $data->title = $validatedData['event_name'];
        $data->location = $validatedData['location'];
        $data->description = $validatedData['description'];


        if ($request->has('eventRadio')) {
            $data->options = $validatedData['eventRadio'];
        }

        if (!empty($validatedData['all_day'])) {
            $date = $validatedData['all_day'];
            $data->start = Carbon::createFromFormat('m/d/Y', $date)
                ->format('Y-m-d');
        }

        if (!empty($validatedData['start_long_event'])) {
            $date = $validatedData['start_long_event'];
            $data->start = Carbon::createFromFormat('m/d/Y', $date)
                ->format('Y-m-d');
        }

        if (!empty($validatedData['end_long_event'])) {
            $date = $validatedData['end_long_event'];
            $data->end = Carbon::createFromFormat('m/d/Y', $date)
                ->format('Y-m-d');
        }

        if (!empty($validatedData['all_day_event_duration'])) {
            $date = $validatedData['all_day_event_duration'];
            $data->start = Carbon::createFromFormat('m/d/Y g:i a', $date)->format('Y-m-d H:i');
        }

        if (!empty($validatedData['start_time_duration'])) {
            $date = $validatedData['start_time_duration'];
            $data->start = Carbon::createFromFormat('m/d/Y g:i a', $date)->format('Y-m-d H:i');
        }

        if (!empty($validatedData['end_time_duration'])) {
            $date = $validatedData['end_time_duration'];
            $data->end = Carbon::createFromFormat('m/d/Y g:i a', $date)->format('Y-m-d H:i');
        }

        $data->save();
        return redirect()->back()->with('success', 'Event added successfully');
    }

    public function calendar()
    {
        $events = [];

        $calendar = Event::get();

        foreach ($calendar as $data) {

            $events[] = [
                'title' => $data->title,
                'start' => $data->start,
                'end' => $data->end,
                'url'   => url('admin/calendar-events', $data->id),
            ];
        }

        return view('admin.calendar-events.calendar.index', compact('events'));
    }

    public function edit($id)
    {
        $data = Event::find($id);

        if ($data->options == 'allday_radio') {
            $val_start = Carbon::createFromFormat('Y-m-d', $data->start);
            $start = $val_start->format('m/d/Y');
        } else {
            $start = '';
        }
        if ($data->options == 'allday_duration') {
            $val_start_time = Carbon::createFromFormat('Y-m-d H:i', $data->start);
            $start_duration = $val_start_time->format('m/d/Y g:i a');
        } else {
            $start_duration = '';
        }
        if ($data->options == 'longevent_radio') {
            $val_start = Carbon::createFromFormat('Y-m-d', $data->start);
            $start_long_event = $val_start->format('m/d/Y');
            $val_end = Carbon::createFromFormat('Y-m-d', $data->end);
            $end_long_event = $val_end->format('m/d/Y');
        } else {
            $start_long_event = '';
            $end_long_event = '';
        }
        if ($data->options == 'time_duration') {
            $val_start_time = Carbon::createFromFormat('Y-m-d H:i', $data->start);
            $start_time_duration = $val_start_time->format('m/d/Y g:i a');
            $val_end_time = Carbon::createFromFormat('Y-m-d H:i', $data->start);
            $end_time_duration = $val_end_time->format('m/d/Y g:i a');
        } else {
            $start_time_duration = '';
            $end_time_duration = '';
        }

        return view('admin.calendar-events.edit', compact('data', 'start', 'start_duration', 'start_long_event', 'end_long_event', 'start_time_duration', 'end_time_duration'));
    }

    public function update(EventRequest $request, $id)
    {
        $validatedData = $request->validated();
        $data = Event::findOrFail($id);
        $data->title = $validatedData['event_name'];
        $data->location = $validatedData['location'];
        $data->description = $validatedData['description'];


        if ($request->has('eventRadio')) {
            $data->options = $validatedData['eventRadio'];
        }

        if (!empty($validatedData['all_day'])) {
            $date = $validatedData['all_day'];
            $data->start = Carbon::createFromFormat('m/d/Y', $date)
                ->format('Y-m-d');
        }

        if (!empty($validatedData['start_long_event'])) {
            $date = $validatedData['start_long_event'];
            $data->start = Carbon::createFromFormat('m/d/Y', $date)
                ->format('Y-m-d');
        }

        if (!empty($validatedData['end_long_event'])) {
            $date = $validatedData['end_long_event'];
            $data->end = Carbon::createFromFormat('m/d/Y', $date)
                ->format('Y-m-d');
        }

        if (!empty($validatedData['all_day_event_duration'])) {
            $date = $validatedData['all_day_event_duration'];
            $data->start = Carbon::createFromFormat('m/d/Y g:i a', $date)->format('Y-m-d H:i');
        }

        if (!empty($validatedData['start_time_duration'])) {
            $date = $validatedData['start_time_duration'];
            $data->start = Carbon::createFromFormat('m/d/Y g:i a', $date)->format('Y-m-d H:i');
        }

        if (!empty($validatedData['end_time_duration'])) {
            $date = $validatedData['end_time_duration'];
            $data->end = Carbon::createFromFormat('m/d/Y g:i a', $date)->format('Y-m-d H:i');
        }

        $data->save();
        return redirect()->back()->with('success', 'Event updated successfully');
    }

    public function destroy(Request $request)
    {
        $user = Event::find($request->event_delete_id);
        $user->delete();
        return redirect('admin/calendar-events')->with('success', 'Event deleted successfully');
    }

    public function deleteAll(MassDeleteRequest $request)
    {
        $ids = $request->ids;
        Event::whereIn('id', $ids)->delete();
        return response()->json([
            'success' => 'Event deleted successfully'
        ]);
    }
}
