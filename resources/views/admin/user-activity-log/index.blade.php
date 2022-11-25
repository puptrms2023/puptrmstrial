@extends('layouts.admin')

@section('title', 'View Activity Log')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Activity Log</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/delete-log') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the activity log?</p>
                        <input type="hidden" name="log_delete_id" id="log_id">
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
                    <h5 class="modal-title">Delete Activity Log</h5>
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
                                    <th>Changed Date</th>
                                    <th>Model</th>
                                    <th>URL</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activity as $act)
                                    <tr>
                                        <td><input type="checkbox" class="user-checkboxes" data-id="{{ $act->id }}">
                                        </td>

                                        <td class="font-weight-bold">
                                            {{ \Carbon\Carbon::parse($act->created_at)->format('F d, Y h:i a ') }}</td>
                                        <td>{{ substr($act->auditable_type, 11) }}</td>
                                        <td>{{ $act->url }}</td>
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
        $('.deleteUserbtn').click(function(e) {
            e.preventDefault();

            var log_id = $(this).val();
            $('#log_id').val(log_id)
            $('#deleteModal').modal('show');

        });
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
