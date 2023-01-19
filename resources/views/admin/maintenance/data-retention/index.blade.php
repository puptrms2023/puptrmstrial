@extends('layouts.admin')

@section('title', 'Data Retention')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Data Retention - Maintenance</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Records
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Name</th>
                                    <th>Day</th>
                                    <th>Duration</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_retention as $list)
                                    <tr>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->period }}</td>
                                        <td>{{ $list->duration }}</td>
                                        <td> <a href="{{ route('retention.edit', $list->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a></td>
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
