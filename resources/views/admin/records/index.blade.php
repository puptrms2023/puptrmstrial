@extends('layouts.admin')

@section('title', 'Courses Maintenance')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete File</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/delete-records') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the file?</p>
                        <input type="hidden" name="media_delete_id" id="m_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="deleteModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete File</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="data-count">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="delbtn btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Recognition Records</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Document List
                        @can('record create')
                            <a class="btn btn-info btn-sm float-right" href="{{ url('admin/records/create') }}">Add
                                Document</a>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center info"><input type="checkbox" name="checkAll" class="checkAll">
                                    </th>
                                    <th>Document Name</th>
                                    <th>Description</th>
                                    <th>File</th>
                                    <th>Action <br>
                                        @can('record delete')
                                            <button class="btn btn-sm btn-danger d-none" id="bulk_delete">
                                                All</button>
                                        @endcan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($document as $key => $list)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" class="user-checkboxes"
                                                data-id="{{ $list->id }}">
                                        </td>
                                        <td>{{ $list->name }}</td>
                                        <td>{{ $list->description }}</td>
                                        <td width="20%">

                                            @foreach ($list->getMedia('document_file') as $file)
                                                <a href="{{ $file->getUrl() }}" target="_blank">
                                                    {{ $file->file_name }}
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/records/view/' . $list->id) }}"
                                                class="btn btn-secondary btn-sm"><i class="fa-regular fa-eye"></i></a>
                                            @can('record edit')
                                                <a href="{{ url('admin/records/' . $list->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('record delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteMediabtn"
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
        $('.deleteMediabtn').click(function(e) {
            e.preventDefault();

            var m_id = $(this).val();
            $('#m_id').val(m_id)
            $('#deleteModal').modal('show');

        });
        $('#bulk_delete').on('click', function() {
            const chkstats = Array.prototype.slice.call(document.querySelectorAll('[data-id]:checked'));
            let arr = chkstats.map(function(c) {
                return c.getAttribute('data-id');
            });
            var selectRowsCount = arr.length;
            $('#data-count').text('Are you sure you want to delete the ' + selectRowsCount +
                ' file(s)?');
            $('#deleteModal2').modal('show');

            $(document).on('click', '.delbtn', function() {
                if (selectRowsCount > 0) {
                    $.ajax({
                        url: "{{ url('admin/records/bulk-delete') }}",
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                .attr('content')
                        },
                        data: {
                            ids: arr
                        },
                        success: function(data) {
                            if (data['success']) {
                                $('#deleteModal2').modal('hide');
                                toastr.success(data.success);
                                setInterval('refreshPage()', 1000);
                            }
                        },
                    });
                } else {
                    alert("Please select at least one file from list.");
                }
            });
        });
    </script>
@endsection
