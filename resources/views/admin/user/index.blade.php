@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/delete-users') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the user account?</p>
                        <input type="hidden" name="user_delete_id" id="user_id">
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
                    <h5 class="modal-title">Delete User</h5>
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
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Users
                        @can('user create')
                            <a class="btn btn-info btn-sm float-right" href="{{ url('admin/users/create') }}"><i
                                    class="fa fa-user fa-sm"></i>&ensp;Add User</a>
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
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions <br>
                                        @can('user delete')
                                            <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                                All</button>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $item)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" class="user-checkboxes"
                                                data-id="{{ $item->id }}">
                                        </td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            @if (!empty($item->getRoleNames()))
                                                @foreach ($item->getRoleNames() as $val)
                                                    <span class="badge badge-success">{{ $val }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('user edit')
                                                <a href="{{ url('admin/users/' . $item->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('user delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteUserbtn"
                                                    value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
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
        $(document).ready(function() {
            $('.deleteUserbtn').click(function(e) {
                e.preventDefault();

                var user_id = $(this).val();
                $('#user_id').val(user_id)
                $('#deleteModal').modal('show');

            });
            $('#bulk_delete').on('click', function() {
                const chkstats = Array.prototype.slice.call(document.querySelectorAll('[data-id]:checked'));
                let arr = chkstats.map(function(c) {
                    return c.getAttribute('data-id');
                });
                var selectRowsCount = arr.length;
                $('#data-count').text('Are you sure you want to delete the ' + selectRowsCount +
                    ' user account?');
                $('#deleteModal2').modal('show');

                $(document).on('click', '.delbtn', function() {
                    if (selectRowsCount > 0) {
                        $.ajax({
                            url: "{{ url('admin/bulk-delete-user') }}",
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
