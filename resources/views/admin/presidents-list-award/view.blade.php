@extends('layouts.admin')

@section('title', $courses->course)

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - President's
    List</div>
</div>

@if(session('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Students
                    <a href="{{ url('admin/presidents-list-award') }}" class="btn btn-primary btn-sm float-right">Back</a>
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
                    <table class="table table-bordered table-striped table-data-pl" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th width="">1st Sem GWA</th>
                                <th>2nd Sem GWA</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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

