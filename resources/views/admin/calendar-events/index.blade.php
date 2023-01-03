@extends('layouts.admin')

@section('title', 'Events')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Event</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/calendar-events/delete-event') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the event?</p>
                        <input type="hidden" name="event_delete_id" id="e_id">
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
                    <h5 class="modal-title">Delete Event</h5>
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
        <div class="h3 mb-0 text-gray-800">Calendar of Events</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Events
                        @can('events create')
                            <a class="btn btn-info btn-sm float-right" href="{{ url('admin/calendar-events/create') }}">Add
                                Event</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center info"><input type="checkbox" name="checkAll" class="checkAll">
                                    </th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Actions <br>
                                        @can('events delete')
                                            <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                                All</button>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $list)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" class="user-checkboxes"
                                                data-id="{{ $list->id }}">
                                        </td>
                                        <td>{{ $list->title }}</td>
                                        <td>{{ $list->location }}</td>
                                        <td>{{ $list->description }}</td>
                                        <td>{{ $list->start }}</td>
                                        <td>{{ $list->end }}</td>
                                        <td>
                                            @can('events edit')
                                                <a href="{{ url('admin/calendar-events/' . $list->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('events delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteCoursebtn"
                                                    value="{{ $list->id }}"><i class="fa fa-trash"></i></button>
                                            @endcan

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
        $('.deleteCoursebtn').click(function(e) {
            e.preventDefault();

            var e_id = $(this).val();
            $('#e_id').val(e_id)
            $('#deleteModal').modal('show');

        });
        $('#bulk_delete').on('click', function() {
            const chkstats = Array.prototype.slice.call(document.querySelectorAll('[data-id]:checked'));
            let arr = chkstats.map(function(c) {
                return c.getAttribute('data-id');
            });
            var selectRowsCount = arr.length;
            $('#data-count').text('Are you sure you want to delete the ' + selectRowsCount +
                ' event?');
            $('#deleteModal2').modal('show');

            $(document).on('click', '.delbtn', function() {
                if (selectRowsCount > 0) {
                    $.ajax({
                        url: "{{ url('admin/calendar-events/bulk-delete') }}",
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
                    alert("Please select at least one record from list.");
                }
            });
        });
    </script>
@endsection
