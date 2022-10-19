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
    <div class="modal" tabindex="-1" id="deleteModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Application Form</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="data-count">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="delbtn btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - Academic Excellence Applicants</div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="form-row">
                <div class="col-lg-3 col-xs-12">
                    <select id="year_ae" class="custom-select">
                        <option value="All" selected>All</option>
                        <option value="4th-Year">4th Year</option>
                        <option value="5th-Year">5th Year</option>
                    </select>
                </div>
                <div class="col-auto col-xs-12">
                    <button type="button" class="btn btn-secondary view-accepted-ae" formtarget="_blank">
                        <i class="fa fa-download fa-sm text-white-100"></i>&ensp;Approved Students
                    </button>
                </div>
                <div class="col-auto col-xs-12">
                    <button type="button" class="btn btn-danger view-rejected-ae" formtarget="_blank">
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
                        <table class="table table-bordered table-striped table-data-ae" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th><input type="checkbox" name="main_checkbox"></th>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Average</th>
                                    <th>Image</th>
                                    <th class="text-center">Status</th>
                                    <th>Actions <br>
                                        @can('acad excellence delete')
                                            <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                                All</button>
                                        @endcan
                                    </th>
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
        var table = $(".table-data-ae").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/academic-excellence-award/' . $courses->course_code) }}",
                data: function(d) {
                    (d.status = $("#status").val()),
                    (d.year = $("#year_ae").val());
                },
            },
            columns: [{
                    data: 'checkbox',
                    name: 'checkbox',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'studno',
                    name: 'users.stud_num'
                },
                {
                    data: 'fname',
                    name: 'users.first_name'
                },
                {
                    data: 'lname',
                    name: 'users.last_name'
                },
                {
                    data: "course",
                    name: "courses.course_code"
                },
                {
                    data: "year_level"
                },
                {
                    data: "gwa"
                },
                {
                    data: "image",
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: "status",
                    className: "text-center"
                },
                {
                    data: "action",
                    orderable: false,
                    searchable: false,
                },
            ],
            'columnDefs': [{
                'targets': 0,
                'searchable': false,
                'orderable': false
            }],
            'order': [
                [1, 'asc']
            ]
        }).on('draw', function() {
            $('input[name="form_checkbox"]').each(function() {
                this.checked = false;
            });
            $('input[name="main_checkbox"]').prop('checked', false);
            $('button#bulk_delete').addClass('d-none');
        });

        $("#year_ae,#status").change(function() {
            table.draw();
        });

        $(function() {
            $(document).ready(function() {
                $('body').on('click', '.deleteFormbtn', function() {

                    var app_form_id = $(this).data("id");
                    $('#form_id').val(app_form_id);
                    $('#deleteModal').modal('show');
                });
            });
            $(document).on('click', '#bulk_delete', function() {

                $('#data-count').text('Are you sure you want to delete the (' + $(
                        'input[name="form_checkbox"]:checked')
                    .length + ') submitted application form?');
                $('#deleteModal2').modal('show');

                $(document).on('click', '.delbtn', function() {
                    var bulkID = [];
                    $('input[name="form_checkbox"]:checked').each(function() {
                        bulkID.push($(this).data('id'));
                    });

                    if (bulkID.length > 0) {
                        var join_selected_values = bulkID.join(",");
                        $.ajax({
                            url: "{{ url('admin/academic-excellence-award/' . $courses->course_code . '/bulk-delete-form') }}",
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            data: "ids=" + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $('.table-data-ae').DataTable().ajax
                                        .reload(null, true);
                                    $('#deleteModal2').modal('hide');
                                    toastr.success(data.success);
                                }
                            },
                        });
                    } else {
                        alert("Please select atleast one checkbox");
                    }
                });
            });
        });
    </script>

@endsection
