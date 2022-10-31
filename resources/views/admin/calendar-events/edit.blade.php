@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')

    <div class="row">
        <div class="col-xl-8">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Edit Event
                    </div>
                </div>
                <div class="card-body">

                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/calendar-events/update/' . $data->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <label class="small">Event Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="event_name" class="form-control" value="{{ $data->title }}"
                                    placeholder="Enter name">
                                @if ($errors->has('event_name'))
                                    <span class="text-danger text-left">{{ $errors->first('event_name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="small">Location</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="location" class="form-control" value="{{ $data->location }}"
                                    placeholder="Enter location">
                                @if ($errors->has('location'))
                                    <span class="text-danger text-left">{{ $errors->first('location') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="small">Description</label>
                                <span class="text-danger">*</span>
                                <textarea id="description" name="description" placeholder="Enter desctiption" class="form-control">{{ $data->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="eventRadio" id="inlineRadio1"
                                        value="allday_radio" {{ $data->options == 'allday_radio' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio1">All Day</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="eventRadio" id="inlineRadio2"
                                        value="longevent_radio" {{ $data->options == 'longevent_radio' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio2">Long Event</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="eventRadio" id="inlineRadio3"
                                        value="allday_duration" {{ $data->options == 'allday_duration' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio3">All Day Event Duration</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="eventRadio" id="inlineRadio4"
                                        value="time_duration" {{ $data->options == 'time_duration' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="inlineRadio4">Time Event Duration</label>
                                </div>
                                @if ($errors->has('eventRadio'))
                                    <br><span class="text-danger text-left">{{ $errors->first('eventRadio') }}</span>
                                @endif
                            </div>
                            {{-- all day --}}
                            <div id="all" class="col-md-12 hidden">
                                <label class="small">Date</label>
                                <div class="input-group date" id="editallDay" data-target-input="nearest">
                                    <input type="text" id="all-value" class="form-control datetimepicker-input"
                                        name="all_day" value="{{ $start }}" data-target="#editallDay">
                                    <div class="input-group-append" data-target="#editallDay" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if ($errors->has('all_day'))
                                    <span class="text-danger text-left">{{ $errors->first('all_day') }}</span>
                                @endif
                            </div>
                            {{-- long event --}}
                            <div id="long" class="col-md-12 mb-3 hidden">
                                <label class="small">Start</label>
                                <div class="input-group date" id="editstartLongDay" data-target-input="nearest">
                                    <input type="text" id="longstart-value" class="form-control datetimepicker-input"
                                        name="start_long_event" value="{{ $start_long_event }}"
                                        data-target="#editstartLongDay">
                                    <div class="input-group-append" data-target="#editstartLongDay"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if ($errors->has('start_long_event'))
                                    <span
                                        class="text-danger text-left">{{ $errors->first('start_long_event') }}</span><br>
                                @endif
                                <label class="small mt-2">End</label>
                                <div class="input-group date" id="editendLongDay" data-target-input="nearest">
                                    <input type="text" id="longend-value" class="form-control datetimepicker-input"
                                        name="end_long_event" value="{{ $end_long_event }}"
                                        data-target="#editendLongDay">
                                    <div class="input-group-append" data-target="#editendLongDay"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if ($errors->has('end_long_event'))
                                    <span class="text-danger text-left">{{ $errors->first('end_long_event') }}</span>
                                @endif
                            </div>
                            {{-- all day --}}
                            <div id="alld" class="col-md-12 mb-3 hidden">
                                <label class="small">Start</label>
                                <div class="input-group date" id="editstartAllDay" data-target-input="nearest">
                                    <input type="text" id="allid-value" class="form-control datetimepicker-input"
                                        name="all_day_event_duration" value="{{ $start_duration }}"
                                        data-target="#editstartAllDay">
                                    <div class="input-group-append" data-target="#editstartAllDay"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if ($errors->has('all_day_event_duration'))
                                    <span
                                        class="text-danger text-left">{{ $errors->first('all_day_event_duration') }}</span>
                                @endif
                            </div>
                            {{-- time event duration --}}
                            <div id="duration" class="col-md-12 mb-3 hidden">
                                <label class="small">Start</label>
                                <div class="input-group date" id="startTimeDuration" data-target-input="nearest">
                                    <input type="text" name="start_time_duration" id="startduration_value"
                                        class="form-control datetimepicker-input" data-target="#startTimeDuration"
                                        value="{{ $start_time_duration }}">
                                    <div class="input-group-append" data-target="#startTimeDuration"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if ($errors->has('start_time_duration'))
                                    <span
                                        class="text-danger text-left">{{ $errors->first('start_time_duration') }}</span><br>
                                @endif
                                <label class="small mt-2">End</label>
                                <div class="input-group date" id="endTimeDuration" data-target-input="nearest">
                                    <input type="text" name="end_time_duration"
                                        id="endduration_value"class="form-control datetimepicker-input"
                                        value="{{ $end_time_duration }}" data-target="#endTimeDuration" />
                                    <div class="input-group-append" data-target="#endTimeDuration"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @if ($errors->has('end_time_duration'))
                                    <span class="text-danger text-left">{{ $errors->first('end_time_duration') }}</span>
                                @endif
                            </div>
                        </div>

                        <button class="btn btn-secondary" type="submit">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            if ($("input[name='eventRadio']:checked").val() == "allday_radio") {
                $("#all").show();
            } else {
                $("#all").hide();
            }
            if ($("input[name='eventRadio']:checked").val() == "longevent_radio") {
                $("#long").show();
            } else {
                $("#long").hide();
            }
            if ($("input[name='eventRadio']:checked").val() == "allday_duration") {
                $("#alld").show();
            } else {
                $("#alld").hide();
            }
            if ($("input[name='eventRadio']:checked").val() == "time_duration") {
                $("#duration").show();
            } else {
                $("#duration").hide();
            }
        });
        $('#editallDay,#editstartLongDay,#editendLongDay').datetimepicker({
            format: 'L'
        });
        $('#editstartAllDay').datetimepicker({
            minDate: new Date(),
            icons: {
                time: "fa-solid fa-clock"
            }
        });
    </script>
@endsection
