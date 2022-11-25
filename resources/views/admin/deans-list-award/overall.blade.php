@extends('layouts.admin')

@section('title', 'Overall')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Move to Archive</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/deans-list-award/delete-form') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to move the record to archive?</p>
                        <input type="hidden" name="form_delete_id" id="form_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info" name="delete">Archive</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="deleteModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Move to Archive</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="data-count">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="delbtn btn btn-info">Archive</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">All - Dean's List Applicants</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Students | <a
                            href="{{ url('admin/archive-all/deans-list-award/') }}" class="text-info">
                            View Archive
                            <a href="{{ url('admin/deans-list-award') }}"
                                class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select id='status' class="custom-select" style="width: 200px">
                            <option value="">All</option>
                            <option value="1">Approved</option>
                            <option value="0">Pending</option>
                            <option value="2">Rejected</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-data-dl-overall" width="100%"
                            cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th><input type="checkbox" name="main_checkbox"></th>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Yr Level</th>
                                    <th>S.Y.</th>
                                    <th width="">1st Sem GWA</th>
                                    <th>2nd Sem GWA</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Status</th>
                                    <th>Actions <br>
                                        @can('deans list delete')
                                            <button class="btn btn-sm btn-info d-none" id="bulk_delete">
                                                All</button>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        var table = $(".table-data-dl-overall").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('admin/deans-list-award/overall') }}",
                data: function(d) {
                    (d.status = $("#status").val());
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
                    data: "school_year"
                },
                {
                    data: "gwa_1st"
                },
                {
                    data: "gwa_2nd"
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

        $("#status").change(function() {
            table.draw();
        });

        $(function() {
            $('body').on('click', '.deleteFormbtn', function() {

                var app_form_id = $(this).data("id");
                $('#form_id').val(app_form_id);
                $('#deleteModal').modal('show');
            });
            $(document).on('click', '#bulk_delete', function() {

                $('#data-count').text('Are you sure you want to move the (' + $(
                        'input[name="form_checkbox"]:checked')
                    .length + ') submitted application form to archive?');
                $('#deleteModal2').modal('show');

                $(document).on('click', '.delbtn', function() {
                    var bulkID = [];
                    $('input[name="form_checkbox"]:checked').each(function() {
                        bulkID.push($(this).data('id'));
                    });
                    if (bulkID.length > 0) {
                        var join_selected_values = bulkID.join(",");
                        $.ajax({
                            url: "{{ url('admin/deans-list-award/bulk-delete-form') }}",
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            data: "ids=" + join_selected_values,
                            success: function(data) {
                                if (data['success']) {
                                    $('.table-data-dl-overall').DataTable().ajax
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
