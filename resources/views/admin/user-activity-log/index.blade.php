@extends('layouts.admin')

@section('title', 'View Activity Log')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Activity Log
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Model</th>
                                    <th>User ID</th>
                                    <th>Event</th>
                                    <th>URL</th>
                                    <th>Ip Address</th>
                                    <th>Audit User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activity as $act)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="font-weight-bold">{{ $act->created_at }}</td>
                                        <td>{{ $act->user_type }}</td>
                                        <td>{{ $act->user_id }}</td>
                                        <td>
                                            @if ($act->event == 'updated')
                                                <span class="badge badge-warning">UPDATE</span>
                                            @endif
                                            @if ($act->event == 'created')
                                                <span class="badge badge-success">CREATE</span>
                                            @endif
                                            @if ($act->event == 'deleted')
                                                <span class="badge badge-danger">DELETE</span>
                                            @endif
                                        </td>
                                        <td>{{ $act->url }}</td>
                                        <td>{{ $act->ip_address }}</td>
                                        <td>{{ $act->auditable_id }}</td>
                                        <td><a href="" class="btn btn-sm btn-secondary">Show</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
