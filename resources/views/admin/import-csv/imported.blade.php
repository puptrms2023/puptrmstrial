@extends('layouts.admin')

@section('title', 'View Imported CSV')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @include('layouts.partials.messages')

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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">CSV Files
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
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
                                            <a href="" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <p class="small text-danger">No Data</p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
