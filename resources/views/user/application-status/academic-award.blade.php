@extends('layouts.user')

@section('title', 'Achievers Award Status')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Academic Award Application Status</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
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
                                    <th>S.Y.</th>
                                    <th>Award Applied</th>
                                    <th>1st Sem GWA</th>
                                    <th>2nd Sem GWA</th>
                                    <th>Average</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($status as $item)
                                    @php
                                        $totalwithSummer = ($item->gwa_1st + $item->gwa_2nd + $item->summer) / 3;
                                    @endphp
                                    <tr>
                                        <td class="font-weight-bold">{{ $item->users->stud_num }}</td>
                                        <td>{{ $item->users->first_name }}</td>
                                        <td>{{ $item->users->last_name }}</td>
                                        <td>{{ $item->courses->course_code }}</td>
                                        <td>{{ $item->year_level }}</td>
                                        <td>{{ $item->school_year }}</td>
                                        <td><span class="badge badge-info">{{ $item->award->name }}</span></td>
                                        <td class="text-center">{{ $item->gwa_1st }}</td>
                                        <td class="text-center">{{ $item->gwa_2nd }}</td>
                                        <td class="text-center">{{ $item->gwa }}</td>
                                        <td class="text-center">
                                            @if ($item->status == '0')
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                            @if ($item->status == '1')
                                                <span class="badge badge-success">Approved</span>
                                            @endif
                                            @if ($item->status == '2')
                                                <span class="badge badge-danger">Rejected</span><br>
                                                <div class="small">
                                                    @if ($item->reason == '1')
                                                        Others: {{ $item->others }}
                                                    @else
                                                        {{ $item->reasons->description }}
                                                    @endif
                                                </div>
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
