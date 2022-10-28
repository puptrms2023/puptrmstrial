@extends('layouts.admin')

@section('title', 'Courses Maintenance')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Digital Signature - Maintenance</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('layouts.partials.messages')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Digital Signatures
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/maintenance/signatures-chk') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead class="text-primary">
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Reports</th>
                                        <th>Certificate</th>
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
                                                <div class="form-check">
                                                    <input class="form-check-input report" type="checkbox" name="report"
                                                        value="1">
                                                </div>
                                            </td>
                                            <td class="text-center">

                                                <div class="form-check">
                                                    <input class="form-check-input certificate" type="checkbox"
                                                        name="certificate" value="1">
                                                </div>

                                            </td>
                                            <td><img src="{{ asset('uploads/signature/' . $list->signature) }}"
                                                    class="img-thumbnail" width="150" alt="Image"></td>
                                            <td>
                                                @can('signature edit')
                                                    <a href="{{ url('admin/maintenance/signatures/' . $list->id) }}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button class="btn btn-sm btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.certificate').click(function() {
            if ($('.certificate:checked').length >= 3) {
                $(".certificate").not(":checked").attr("disabled", true);
            } else
                $(".certificate").not(":checked").removeAttr('disabled');
        });
        $('.report').click(function() {
            if ($('.report:checked').length >= 3) {
                $(".report").not(":checked").attr("disabled", true);
            } else
                $(".report").not(":checked").removeAttr('disabled');
        });
    </script>
@endsection
