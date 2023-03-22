@extends('layouts.admin')

@section('title', 'Programs Maintenance')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Subject</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/maintenance/delete-subjects') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the subject?</p>
                        <input type="hidden" name="sub_delete_id" id="c_id">
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
        <div class="h3 mb-0 text-gray-800">Subjects - Maintenance</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Subjects
                        @can('subject create')
                            <a class="btn btn-info btn-sm float-right" href="{{ url('admin/maintenance/subjects/create') }}">Add
                                Subject</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Course Code</th>
                                    <th>Course Description</th>
                                    <th>Actions <br>
                                        @can('subject delete')
                                            <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                                All</button>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subjects as $list)
                                    <tr>
                                        <td>{{ $list->s_code }}</td>
                                        <td>{{ $list->s_name }}</td>
                                        <td>
                                            @can('subject edit')
                                                <a href="{{ url('admin/maintenance/subjects/' . $list->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('subject delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteSubjectbtn"
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
        $('.deleteSubjectbtn').click(function(e) {
            e.preventDefault();

            var c_id = $(this).val();
            $('#c_id').val(c_id)
            $('#deleteModal').modal('show');

        });
    </script>
@endsection
