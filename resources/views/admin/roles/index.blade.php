@extends('layouts.admin')

@section('title', 'Roles')

@section('content')

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Role</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/delete-role') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the role?</p>
                        <input type="hidden" name="role_delete_id" id="role_id">
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Roles
                        @can('role create')
                            <a class="btn btn-info btn-sm float-right" href="{{ url('admin/roles/create') }}"><i
                                    class="fa fa-user fa-sm"></i>&ensp;Add Role</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><span class="badge badge-success">{{ $role->name }}</span></td>
                                        <td>
                                            @if (!empty($role->permissions))
                                                @foreach ($role->permissions as $permission)
                                                    <span class="badge badge-secondary">{{ $permission->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @can('role edit')
                                                <a href="{{ url('admin/roles/' . $role->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('role delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteRolebtn"
                                                    value="{{ $role->id }}"><i class="fa fa-trash"></i></button>
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
            $('.deleteRolebtn').click(function(e) {
                e.preventDefault();

                var role_id = $(this).val();
                $('#role_id').val(role_id)
                $('#deleteModal').modal('show');

            });
        });
    </script>

@endsection
