@extends('layouts.admin')

@section('title', 'Form Maintenance')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Form - Maintenance</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Form
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Requirements</th>
                                    <th>Actions <br>
                                        <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                            All</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form as $list)
                                    <tr>
                                        <td><img src="{{ asset('uploads/form/' . $list->photocard) }}" class="img-thumbnail"
                                                width="150" alt="Image"></td>
                                        <td>{{ $list->award_form }}</td>
                                        <td>
                                            @foreach ($list->requirements as $reqs)
                                                {{ $reqs['requirement'] }}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/maintenance/form/' . $list->id) }}"
                                                class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
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

@endsection
