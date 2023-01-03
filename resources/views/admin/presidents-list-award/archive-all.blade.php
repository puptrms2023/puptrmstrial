@extends('layouts.admin')

@section('title', 'All Archive')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Archives President's Listers</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Students
                        <a href="{{ url('admin/presidents-list-award/overall') }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>S.Y.</th>
                                    <th width="">1st Sem GWA</th>
                                    <th>2nd Sem GWA</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form as $data)
                                    <tr>
                                        <td>{{ $data->users->stud_num }}</td>
                                        <td>
                                            {{ $data->users->first_name }} </td>
                                        <td>{{ $data->users->last_name }}</td>
                                        <td>{{ $data->courses->course_code }}</td>
                                        <td>{{ $data->school_year }}</td>
                                        <td>{{ $data->gwa_1st }}</td>
                                        <td>{{ $data->gwa_2nd }}</td>
                                        <td><img src="{{ asset('uploads/' . $data->image) }}" alt="img"
                                                class="img-thumbnail img-circle" width="50"></td>
                                        <td>
                                            @if ($data->status == '0')
                                                Pending
                                            @elseif($data->status == '1')
                                                Approved
                                            @else
                                                Rejected
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
