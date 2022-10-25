@extends('layouts.admin')

@section('title', 'All Non Academic Applicants')

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
                <form action="{{ url('admin/non-academic-award/delete-form') }}" method="POST">
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
        <div class="h3 mb-0 text-gray-800">All - Non Academic Award Applicant</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">
                        Students
                        <a href="{{ url('admin/non-academic-award') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-primary">
                            <tr>
                                <th class="text-center info"><input type="checkbox" name="checkAll" class="checkAll">
                                </th>
                                <th>Student No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Year Level</th>
                                <th>Award Applied</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Actions <br>
                                    @can('non-acad excellence delete')
                                        <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                            All</button>
                                    @endcan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($form as $award)
                                <tr>
                                    <td><input type="checkbox" class="user-checkboxes" data-id="{{ $award->id }}">
                                    </td>
                                    <td>{{ $award->users->stud_num }}</td>
                                    <td>{{ $award->users->first_name }}</td>
                                    <td>{{ $award->users->last_name }}</td>
                                    <td>{{ $award->courses->course_code }}</td>
                                    <td>{{ $award->year_level }}</td>
                                    <td>
                                        @if ($award->nonacad_id == '1')
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            <div class="small">
                                                <P>School Organization: {{ $award->orgs->name }}</p>
                                            </div>
                                        @elseif ($award->nonacad_id == '2')
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            <div class="small">
                                                <P>Sport: {{ $award->sports }}</p>
                                            </div>
                                        @elseif ($award->nonacad_id == '3')
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            <div class="small">
                                                <P>School Organization: {{ $award->orgs->name }}</p>
                                            </div>
                                        @elseif ($award->nonacad_id == '4')
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            <div class="small">
                                                <P>Subject Name: {{ $award->subject_name }}<br>
                                                    Thesis Title: {{ $award->thesis_title }}</p>
                                            </div>
                                        @elseif ($award->nonacad_id == '5')
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            <div class="small">
                                                <P>School Organization: {{ $award->orgs->name }}</p>
                                            </div>
                                        @elseif ($award->nonacad_id == '6')
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            <div class="small">
                                                <P>Designation Office: {{ $award->designated_office }}<br>
                                                    School Organization: {{ $award->orgs->name }}</p>
                                            </div>
                                        @elseif ($award->nonacad_id == '7')
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            <div class="small">
                                                <P>Competition Name: {{ $award->competition_name }}<br>
                                                    Placements: {{ $award->placement }}<br>
                                                    School Organization: {{ $award->orgs->name }}</p>
                                            </div>
                                        @else
                                            <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <img src="{{ asset('uploads/' . $award->image) }}" class="img-thumbnail img-circle"
                                            width="50" alt="Image">
                                    </td>
                                    <td>
                                        @if ($award->status == '1')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($award->status == '2')
                                            <span class="badge badge-danger">Rejected</span>
                                            <div class="small">
                                                <P>{{ $award->reason }}</p>
                                            </div>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/non-academic-award/' . $award->nonacad_id . '/' . $award->id) }}"
                                            class="btn btn-secondary btn-sm"><i class="fa-regular fa-eye"></i></a>

                                        <button type="button" class="btn btn-sm btn-danger deleteFormbtn"
                                            value="{{ $award->id }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.deleteFormbtn').click(function(e) {
                e.preventDefault();

                var user_id = $(this).val();
                $('#form_id').val(user_id)
                $('#deleteModal').modal('show');
            });

            $('#bulk_delete').on('click', function() {
                const chkstats = Array.prototype.slice.call(document.querySelectorAll('[data-id]:checked'));
                let arr = chkstats.map(function(c) {
                    return c.getAttribute('data-id');
                });
                var selectRowsCount = arr.length;
                $('#data-count').text('Are you sure you want to delete the ' + selectRowsCount +
                    ' submitted application form?');
                $('#deleteModal2').modal('show');

                $(document).on('click', '.delbtn', function() {
                    if (selectRowsCount > 0) {
                        $.ajax({
                            url: "{{ url('admin/non-academic-award/bulk-delete-form') }}",
                            type: "DELETE",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                    .attr('content')
                            },
                            data: {
                                ids: arr
                            },
                            success: function(data) {
                                if (data['success']) {
                                    $('#deleteModal2').modal('hide');
                                    toastr.success(data.success);
                                    setInterval('refreshPage()', 1000);
                                }
                            },
                        });
                    } else {
                        alert("Please select at least one user from list.");
                    }
                });
            });
        });
    </script>
@endsection
