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
                <div class="m-0 font-weight-bold text-primary">Students
                    <div class="mt-2">
                        <a class="btn btn-success btn-sm" href="http://localhost/aaaspupt/pl_bsa_secondyr"><i
                                class="fa fa-star"></i>&nbsp;President Listers</a>
                        <a class="btn btn-danger btn-sm" href="http://localhost/aaaspupt/nonpl_bsa_secondyr"><i
                                class="fa fa-user"></i>&nbsp;Non-President Listers</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Student No.</th>
                                <th>F. Name</th>
                                <th>L. Name</th>
                                <th>Course</th>
                                <th>Yr Level</th>
                                <th>1st GWA</th>
                                <th>2nd GWA</th>
                                <th>CE</th>
                                <th>Average GWA</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($users as $item) --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                {{-- <td class="font-weight-bold">{{ $item->stud_num }}</td> --}}
                                {{-- <td>{{ $item->username }}</td> --}}
                                {{-- <td>{{ $item->first_name }}</td> --}}
                                {{-- <td>{{ $item->last_name }}</td> --}}
                                {{-- <td>{{ $item->email }}</td> --}}
                                {{-- <td>
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
                                </td> --}}
                            </tr>
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                    <a href="http://localhost/aaaspupt/AdminPLSecondYear/pl_bsa_2ndyr_pdfdetails" target="_blank"
                        class="btn btn-sm btn-primary mt-2 mb-3"><i
                            class="fa fa-download fa-sm text-white-100"></i>&ensp;Print
                        Report</a>
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