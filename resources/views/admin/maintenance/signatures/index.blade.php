@extends('layouts.admin')

@section('title', 'Courses Maintenance')

@section('content')

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User Signatories</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/maintenance/delete-signature') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the user?</p>
                        <input type="hidden" name="user_delete_id" id="c_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Digital Signature - Maintenance</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.messages')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Digital Signatures
                        @can('signature create')
                            <a class="btn btn-info btn-sm float-right"
                                href="{{ url('admin/maintenance/signatures/create') }}">Add
                                Signature</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Certificate</th>
                                    <th>Reports</th>
                                    <th>Signature</th>
                                    <th>Actions </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sig as $list)
                                    <tr>
                                        <td>{{ $list->rep_name }}</td>
                                        <td>{{ $list->position }}</td>
                                        <td class="text-center">
                                            <input data-id="{{ $list->id }}" class="toggle-class cert" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive"
                                                {{ $list->certificate ? 'checked' : '' }}>
                                        </td>
                                        <td class="text-center">
                                            <input data-id="{{ $list->id }}" class="toggle-class report" type="checkbox"
                                                data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                data-on="Active" data-off="InActive" {{ $list->report ? 'checked' : '' }}>
                                        </td>
                                        <td><img src="{{ asset('uploads/signature/' . $list->signature) }}"
                                                class="img-thumbnail" width="150" alt="Image"></td>
                                        <td>
                                            @can('signature edit')
                                                <a href="{{ url('admin/maintenance/signatures/' . $list->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('signature delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteSignaturebtn"
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
        $('.deleteSignaturebtn').click(function(e) {
            e.preventDefault();

            var c_id = $(this).val();
            $('#c_id').val(c_id)
            $('#deleteModal').modal('show');

        });
        $(function() {
            $('.cert').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    url: '/admin/maintenance/signatures-cert/' + user_id + '/' + status,
                    data: {
                        'certificate': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        if (data['success']) {
                            toastr.success(data.success);
                        } else {
                            toastr.error(data.error);
                        }
                    },
                });
            })
            $('.report').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    url: '/admin/maintenance/signatures-report/' + user_id + '/' + status,
                    data: {
                        'report': status,
                        'user_id': user_id
                    },
                    success: function(data) {
                        if (data['success']) {
                            toastr.success(data.success);
                        } else {
                            toastr.error(data.error);
                        }
                    },
                });
            })
        })
    </script>
@endsection
