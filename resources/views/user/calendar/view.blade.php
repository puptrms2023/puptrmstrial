@extends('layouts.user')

@section('title', 'View Event')

@section('content')

    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <a href="{{ url('user/calendar') }}" class="btn btn-primary btn-sm float-right">Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="mb-2">
                            <p>Event: <b>{{ $events->title }}</b></p>
                            <p>Location: {{ $events->location }}</p>
                            <p>Description: {{ $events->description }}</p>
                            <p>Time:
                                @if ($events->options == 'allday_duration')
                                    {{ \Carbon\Carbon::parse($events->start)->toDayDateTimeString() }} -
                                    {{ \Carbon\Carbon::parse($events->end)->toDayDateTimeString() }}
                                @elseif ($events->options == 'time_duration')
                                    {{ \Carbon\Carbon::parse($events->start)->toDayDateTimeString() }}
                                @elseif ($events->options == 'allday_radio')
                                    {{ \Carbon\Carbon::parse($events->start)->toFormattedDateString() }}
                                @elseif ($events->options == 'longevent_radio')
                                    {{ \Carbon\Carbon::parse($events->start)->toFormattedDateString() }} -
                                    {{ \Carbon\Carbon::parse($events->end)->toFormattedDateString() }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
