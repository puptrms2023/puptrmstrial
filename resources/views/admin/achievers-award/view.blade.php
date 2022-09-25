@extends('layouts.admin')

@section('title', $courses->course)

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - Achiever's Awardees</div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{ url('admin/achievers-award/' . $courses->course_code . '/view-approved-students-pdf') }}"
                target="__blank" class="btn btn-secondary">
                <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Approved Students
            </a>
            <a href="{{ url('admin/achievers-award/' . $courses->course_code . '/view-rejected-students-pdf') }}"
                target="__blank" class="btn btn-danger">
                <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Rejected Students
            </a>
        </div>
    </div>
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
                        <table class="table table-bordered table-striped table-data" id="dataTable" width="100%"
                            cellspacing="0">
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
                            </tbody>
                        </table>
                        <a href="{{ url('admin/achievers-award/' . $courses->course_code . '/view-all-students-pdf') }}"
                            target="__blank" class="btn btn-sm btn-primary mt-2 mb-3">
                            <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Print Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
