@extends('layouts.user')

@section('title','Achievers Award Application')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="h3 mb-0 text-gray-800">Application Status</div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Status
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Award Applied</th>
                                <th>1st Sem GWA</th>
                                <th>2nd Sem GWA</th>
                                <th>Image</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($status as $item)
                            <tr>
                                <td class="font-weight-bold">{{ $item->users->stud_num }}</td>
                                <td>{{ $item->users->first_name }}</td>
                                <td>{{ $item->users->last_name }}</td>
                                <td>{{ $item->courses->course_code }}</td>
                                <td>{{ $item->year_level }}</td>
                                <td>
                                    @if ($item->award_applied=='1')
                                    <span class="badge badge-danger">Achiever's Award</span>
                                    @endif
                                    @if ($item->award_applied=='2')
                                    <span class="badge badge-info">Dean's List</span>
                                    @endif
                                    @if ($item->award_applied=='3')
                                    <span class="badge badge-warning">President's List</span>
                                    @endif
                                    @if ($item->award_applied=='4')
                                    <span class="badge badge-suceess">Academic Excellence</span>
                                    @endif
                                </td>
                                <td>{{ $item->gwa_1st }}</td>
                                <td>{{ $item->gwa_2nd }}</td>
                                <td>
                                    <img src="{{ asset('uploads/'.$item->image) }}" class="img-thumbnail img-circle"
                                        width="50" alt="Image">
                                </td>
                                <td>
                                    @if ($item->status=='0')
                                    <span class="badge badge-warning">Pending</span>
                                    @endif
                                    @if ($item->status=='1')
                                    <span class="badge badge-success">Accepted</span>
                                    @endif
                                    @if ($item->status=='2')
                                    <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
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
