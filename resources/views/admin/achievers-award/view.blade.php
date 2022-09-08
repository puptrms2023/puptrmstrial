@extends('layouts.admin')

@section('title', $courses->course)

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - Achiever's Awardees</div>
</div>

@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Students
                    <a href="{{ url('admin/achievers-award') }}" class="btn btn-primary btn-sm float-right">Back</a>
                </div>
            </div>
            <div class="card-body">
                <input type="hidden" value="{{ $courses->course_code }}" id="course_id">
                <div class="form-group">
                    <select id='status' class="custom-select" style="width: 200px">
                        <option value="">All</option>
                        <option value="1">Approved</option>
                        <option value="0">Pending</option>
                        <option value="2">Rejected</option>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-data" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th width="">1st Sem GWA</th>
                                <th>2nd Sem GWA</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($status as $item)
                            <tr>
                                <td class="font-weight-bold">{{ $item->users->stud_num }}</td>
                                <td>{{ $item->users->first_name }}</td>
                                <td>{{ $item->users->last_name }}</td>
                                <td>{{ $item->courses->course_code }}</td>
                                <td>{{ $item->gwa_1st }}</td>
                                <td>{{ $item->gwa_2nd }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('uploads/'.$item->image) }}" class="img-thumbnail img-circle"
                                        width="50" alt="Image">
                                </td>
                                <td class="text-center">
                                    @if ($item->status=='0')
                                    <a href="{{ url('admin/achievers-award/'.$item->courses->course_code . '/approve/'.$item->id) }}" class="btn btn-success btn-sm btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-check"></i>
                                        </span>
                                        <span class="text">Approve</span>
                                    </a>
                                    <a href="{{ url('admin/achievers-award/'.$item->courses->course_code . '/reject/'.$item->id) }}" class="btn btn-danger btn-sm btn-icon-split" >
                                        <span class="icon text-white-50">
                                            <i class="fa-sharp fa-solid fa-xmark"></i>
                                        </span>
                                        <span class="text">Reject</span>
                                    </a>
                                    @endif
                                    @if ($item->status=='1')
                                    <span class="badge badge-success">Accepted</span>
                                    @endif
                                    @if ($item->status=='2')
                                    <span class="badge badge-danger">Rejected</span>
                                        @if ($item->reason !='')
                                        <br /><small>{{ $item->reason }}</small>
                                        @endif
                                    @endif
                                </td>
                                </td>
                                <td>
                                    <a href="{{ url('admin/achievers-award/'.$item->courses->course_code . '/'.$item->id) }}" class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger deleteUserbtn"
                                        value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                    <a href="http://localhost/aaaspupt/AdminPLSecondYear/pl_bsa_2ndyr_pdfdetails" target="_blank"
                        class="btn btn-sm btn-primary mt-2 mb-3"><i
                            class="fa fa-download fa-sm text-white-100"></i>&ensp;Print
                        Report</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

