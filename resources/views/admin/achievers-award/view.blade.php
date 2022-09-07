@extends('layouts.admin')

@section('title', $courses->course)

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - Achiever's Awardees</div>
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
                <div class="m-0 font-weight-bold text-primary">Students
                    <div class="mt-2">
                        <a class="btn btn-warning btn-sm" href="http://localhost/aaaspupt/pl_bsa_secondyr"><i
                                class="fa fa-star"></i>&nbsp;Achievers</a>
                        <a class="btn btn-danger btn-sm" href="http://localhost/aaaspupt/nonpl_bsa_secondyr"><i
                                class="fa fa-user"></i>&nbsp;Non-Achievers</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student No.</th>
                                <th>Name</th>
                                <th>1st Sem GWA</th>
                                <th>2nd Sem GWA</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($status as $item)
                            <tr>
                                <td class="font-weight-bold">{{ $item->users->stud_num }}</td>
                                <td>{{ $item->users->first_name.' '.$item->users->last_name }}</td>
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
                                    @endif
                                </td>
                                </td>
                                <td>
                                    <a href="{{ url('admin/achievers-award/'.$item->courses->course_code . '/'.$item->id) }}" class="btn btn-sm btn-secondary"><i class="fa-regular fa-eye"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger deleteUserbtn"
                                        value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
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

