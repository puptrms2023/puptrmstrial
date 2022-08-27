@extends('layouts.admin')

@section('title','View Users')

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

<div class="row">
    <div class="col-md-12">
        @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Users
                    <a class="btn btn-info btn-sm float-right" href="{{ url('admin/users/create') }}"><i
                            class="fa fa-user fa-sm"></i>&ensp;Add User</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Enail</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                            <tr>
                                <td>{{ $item->stud_num }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->first_name }}</td>
                                <td>{{ $item->last_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>
                                    @if ($item->role_as=='1')
                                    <span class="badge badge-success">Admin</span>
                                    @endif
                                    @if ($item->role_as=='0')
                                    <span class="badge badge-warning">Student</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/users/'.$item->id) }}" class="btn btn-sm btn-success"><i
                                            class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-sm btn-danger deleteUserbtn"
                                        value="{{ $item->id }}"><i class="fa fa-trash"></i></button>
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
    $(document).ready(function () {
        $('.deleteUserbtn').click(function (e) { 
            e.preventDefault();

            var user_id = $(this).val();
            $('#user_id').val(user_id)
            $('#deleteModal').modal('show');
            
        });
    });
</script>

@endsection