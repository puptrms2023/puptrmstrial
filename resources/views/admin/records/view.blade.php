@extends('layouts.admin')

@section('title', 'Show Record')

@section('content')

    @include('layouts.partials.messages')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">
                        Show Document
                        <a href="{{ url('admin/records') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th width="25%">Name</th>
                                <td>{{ $document->name }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Description</th>
                                <td>{{ $document->description }}</td>
                            </tr>
                            <tr>
                                <th width="25%">File</th>
                                <td>
                                    {{ $document->document_file->file_name }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="float-right"> Added at {{ $document->created_at }}</small>
                </div>
            </div>
        </div>
    </div>
@endsection
