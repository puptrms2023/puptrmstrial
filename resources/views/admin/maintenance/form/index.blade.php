@extends('layouts.admin')

@section('title', 'Courses Maintenance')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Digital Signature - Maintenance</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Digital Signatures
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Signature</th>
                                    <th>Actions <br>
                                        <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                            All</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($sig as $list) --}}
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {{-- <td>{{ $list->name }}</td>
                                        <td>{{ $list->position }}</td>
                                        <td><img src="{{ asset('uploads/signature/' . $list->signature) }}"
                                                class="img-thumbnail" width="150" alt="Image"></td>
                                        <td>
                                            <a href="{{ url('admin/maintenance/signatures/' . $list->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                        </td> --}}
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
