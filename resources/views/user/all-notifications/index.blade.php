@extends('layouts.user')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pt-3 pb-1">
                    <div class="text-primary font-weight-bold">
                        Notifications
                    </div>
                </div>
                <div class="card-body">
                    @foreach (Auth::user()->notifications as $list)
                        <div class="alert alert-success">
                            [{{ $list->created_at }}] <b><span class="font-weight-bold">
                                    Your Application for
                                    @if ($list->data['award'] == '1')
                                        Achiever's Award
                                    @elseif ($list->data['award'] == '2')
                                        Dean's list
                                    @elseif ($notification->data['award'] == '3')
                                        President's List
                                    @elseif ($list->data['award'] == '4')
                                        Academic Excellence
                                    @endif
                                    has been
                                    @if ($list->data['status'] == '1')
                                        Approved
                                    @elseif ($list->data['status'] == '2')
                                        Rejected
                                    @endif
                                </span></b>
                            <span class="float-right">
                                <a href="{{ url('user/delete-notification/' . $list->data['form_id']) }}"
                                    class="float-right">Delete
                                </a>
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
