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
                <form action="{{ url('admin/deans-list-award/' . $courses->course_code . '/delete-form') }}" method="POST">
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
        <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - Dean's List Applicants</div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-row">
                <div class="col-lg-3 col-xs-12">
                    <select id="year" class="custom-select" id="inlineFormCustomSelectPref">
                        <option value="All" selected>All Year Levels</option>
                        <option value="2nd-Year">2nd Year</option>
                        <option value="3rd-Year">3rd Year</option>
                        <option value="4th-Year">4th Year</option>
                    </select>
                </div>
                <div class="col-auto col-xs-12">
                    <button type="button" class="btn btn-secondary view-accepted" formtarget="_blank">
                        <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Approved Students
                    </button>
                </div>
                <div class="col-auto col-xs-12">
                    <button type="button" class="btn btn-danger view-rejected" formtarget="_blank">
                        <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Rejected Students
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Students
                        <a href="{{ url('admin/deans-list-award') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <input type="hidden" value="{{ $courses->course_code }}" id="course_id">
                    <div class="form-group">
                        <select id='status' class="custom-select col-lg-2 col-sm-12">
                            <option value="">All</option>
                            <option value="1">Approved</option>
                            <option value="0">Pending</option>
                            <option value="2">Rejected</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-data-dl" id="dataTable" width="100%"
                            cellspacing="0">
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
                        <a href="{{ url('admin/deans-list-award/' . $courses->course_code . '/view-approved-students-pdf') }}"
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
