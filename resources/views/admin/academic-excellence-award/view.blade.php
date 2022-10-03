@extends('layouts.admin')

@section('title', $courses->course)

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Application Form</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/academic-excellence-award/' . $courses->course_code . '/delete-form') }}"
                    method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the submitted application form?</p>
                        <input type="hidden" name="form_delete_id" id="form_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - Academic Excellence Applicants</div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <a href="{{ url('admin/academic-excellence-award/' . $courses->course_code . '/view-approved-students-pdf') }}"
                target="__blank" class="btn btn-secondary">
                <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Approved Students
            </a>
            <a href="{{ url('admin/academic-excellence-award/' . $courses->course_code . '/view-rejected-students-pdf') }}"
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
                        <a href="{{ url('admin/academic-excellence-award') }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
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
                        <table class="table table-bordered table-striped table-data-ae" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Average</th>
                                    <th>Image</th>
                                    <th class="text-center">Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <a href="{{ url('admin/academic-excellence-award/' . $courses->course_code . '/view-all-students-pdf') }}"
                            target="__blank" class="btn btn-sm btn-primary mt-2 mb-3">
                            <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Print Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('body').on('click', '.deleteFormbtn', function() {

                var app_form_id = $(this).data("id");
                $('#form_id').val(app_form_id);
                $('#deleteModal').modal('show');
            });
        });
    </script>

@endsection