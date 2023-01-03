@extends('layouts.admin')

@section('title', 'Imported CSV')

@section('content')

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete CSV File</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/delete-csv') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the csv file?</p>
                        <input type="hidden" name="file_delete_id" id="file_id">
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
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @include('layouts.partials.messages')

            @can('csv create')
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="m-0 font-weight-bold text-primary">CSV Import
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/import-csv/import-parse') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-inline mb-2">
                                <label for="csv_file" class="control-label">CSV file to import</label>

                                <div class="col-md-4">
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="text-danger text-left">{{ $errors->first('csv_file') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group hidden">
                                <div class="col-md-4 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input id="header" type="checkbox" name="header" checked> File contains header
                                            row?
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-secondary">
                                Parse CSV
                            </button>

                        </form>
                    </div>
                </div>
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">CSV Files
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>File name</th>
                                    <th>Date</th>
                                    <th width="2%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($csv as $list)
                                    <tr>
                                        <td width="10%">{{ $loop->iteration }}</td>
                                        <td>{{ $list->csv_filename }}</td>
                                        <td>{{ $list->created_at }}</td>
                                        <td>
                                            @can('csv delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteCSVbtn"
                                                    value="{{ $list->id }}"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
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
            $('.deleteCSVbtn').click(function(e) {
                e.preventDefault();

                var file_id = $(this).val();
                $('#file_id').val(file_id)
                $('#deleteModal').modal('show');

            });
        });
    </script>

@endsection
