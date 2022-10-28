@extends('layouts.admin')

@section('title', 'View All Notification')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Notification</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/delete-notification') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the notification?</p>
                        <input type="hidden" name="notify_delete_id" id="notify_id">
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
                    <h5 class="modal-title">Delete Notification</h5>
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
                    <div class="m-0 font-weight-bold text-primary">Notification
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
                                    <th>Subject</th>
                                    <th>Actions <br>
                                        <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                            All</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->notifications as $notification)
                                    <tr>
                                        <td><input type="checkbox" class="user-checkboxes"
                                                data-id="{{ $notification->id }}">
                                        </td>

                                        <td class="font-weight-bold">
                                            {{ \Carbon\Carbon::parse($notification->created_at)->format('F d, Y h:i a ') }}
                                        </td>
                                        <td>
                                            {{ $notification->data['user_name'] }}
                                            submiited application for
                                            @if ($notification->data['award'] == 'AA')
                                                Achiever's Award
                                            @elseif ($notification->data['award'] == 'DL')
                                                Dean's List
                                            @elseif ($notification->data['award'] == 'PL')
                                                President's List
                                            @elseif ($notification->data['award'] == 'AE')
                                                Academic Excellence
                                            @elseif ($notification->data['award'] == 'LA')
                                                Leadership Award
                                            @elseif ($notification->data['award'] == 'AYA')
                                                Athlete of the Year Award
                                            @elseif ($notification->data['award'] == 'OOA')
                                                Outstanding Organization Award
                                            @elseif ($notification->data['award'] == 'BTA')
                                                Best Thesis Award
                                            @elseif ($notification->data['award'] == 'GOP')
                                                Graduating Organization Presidents
                                            @elseif ($notification->data['award'] == 'GSA')
                                                Graduating Student Assistants
                                            @elseif ($notification->data['award'] == 'OC')
                                                Outside Competitions
                                            @elseif ($notification->data['award'] == 'GPDT')
                                                Graduating member of PUPT Dance Troupe
                                            @elseif ($notification->data['award'] == 'GPCG')
                                                Graduating member of PUPT Choral Group (CHANTERS)
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger deleteUserbtn"
                                                value="{{ $notification->id }}"><i class="fa fa-trash"></i></button>
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

            var notify_id = $(this).val();
            $('#notify_id').val(notify_id)
            $('#deleteModal').modal('show');

        });
        $('#bulk_delete').on('click', function() {
            const chkstats = Array.prototype.slice.call(document.querySelectorAll('[data-id]:checked'));
            let arr = chkstats.map(function(c) {
                return c.getAttribute('data-id');
            });
            var selectRowsCount = arr.length;
            $('#data-count').text('Are you sure you want to delete the ' + selectRowsCount +
                ' notifications?');
            $('#deleteModal2').modal('show');

            $(document).on('click', '.delbtn', function() {
                if (selectRowsCount > 0) {
                    $.ajax({
                        url: "{{ url('admin/bulk-delete-notifications') }}",
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
