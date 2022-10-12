@extends('layouts.admin')

@section('title', 'View Activity Log')

@section('content')
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
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Activity Log
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-striped" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center info"><input type="checkbox" name="checkAll" class="checkAll">
                                    </th>
                                    <th>Date</th>
                                    <th>Model</th>
                                    <th>User ID</th>
                                    <th>Event</th>
                                    <th>URL</th>
                                    <th>Ip Address</th>
                                    <th>Audit User</th>
                                    <th>Actions <br>
                                        @can('student delete')
                                            <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                                All</button>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activity as $act)
                                    <tr>
                                        <td><input type="checkbox" class="user-checkboxes" data-id="{{ $act->id }}">
                                        </td>
                                        <td class="font-weight-bold">{{ $act->created_at }}</td>
                                        <td>{{ $act->auditable_type }}</td>
                                        <td>{{ $act->user_id }}</td>
                                        <td>
                                            @if ($act->event == 'updated')
                                                <span class="badge badge-warning">UPDATE</span>
                                            @endif
                                            @if ($act->event == 'created')
                                                <span class="badge badge-success">CREATE</span>
                                            @endif
                                            @if ($act->event == 'deleted')
                                                <span class="badge badge-danger">DELETE</span>
                                            @endif
                                        </td>
                                        <td>{{ $act->url }}</td>
                                        <td>{{ $act->ip_address }}</td>
                                        <td>{{ $act->auditable_id }}</td>
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

@section('scripts')
    <script>
        $('#bulk_delete').on('click', function() {
            const chkstats = Array.prototype.slice.call(document.querySelectorAll('[data-id]:checked'));
            let arr = chkstats.map(function(c) {
                return c.getAttribute('data-id');
            });
            var selectRowsCount = arr.length;
            $('#data-count').text('Are you sure you want to delete the ' + selectRowsCount +
                ' activity log?');
            $('#deleteModal2').modal('show');

            $(document).on('click', '.delbtn', function() {
                if (selectRowsCount > 0) {
                    $.ajax({
                        url: "{{ url('admin/bulk-delete-log') }}",
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
    </script>
@endsection
