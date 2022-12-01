@extends('layouts.admin')

@section('title', 'Form Maintenance')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="text-primary font-weight-bold m-0">{{ $form->award_form }} <a
                            href="{{ url('admin/maintenance/form') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    @include('layouts.partials.messages')

                    <form action="{{ url('admin/maintenance/update-form/' . $form->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if ($form->photocard)
                            <div class="form-group row">
                                <div class="col-md-5 mb-2">
                                    <label class="text-gray font-weight-bold">Photo Card <span
                                            class="text-danger">*</span></label>
                                    <div class="mb-2"><img src="{{ asset('uploads/form/' . $form->photocard) }}"
                                            class="img-thumbnail" alt="image">
                                    </div>
                                    <input type="file" class="form-control" name="photocard">
                                    <input type="hidden" value="{{ $form->photocard }}" name="old_photo">
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" name="add" id="add-btn" class="btn btn-success">Add
                                    More</button>
                                <div class="p-0 mt-2">
                                    <table class="table table-bordered" id="dynamicAddRemove">
                                        <tr>
                                            <th>Requirement</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($requirements as $key => $reqs)
                                            <tr>
                                                <td><input type="text" name="requirements[{{ $key }}][title]"
                                                        placeholder="Enter requirement" class="form-control"
                                                        value="{{ $reqs->requirements }}" />
                                                    <input type="hidden" name="requirements[{{ $key }}][id]"
                                                        value="{{ $reqs->id }}" />
                                                </td>
                                                <td><button type="button" class="btn btn-danger remove-tr deleteReq"
                                                        value="{{ $reqs->id }}">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Requirement</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/maintenance/delete-reqs-form') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the requirement?</p>
                        <input type="hidden" name="req_delete_id" id="req_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="requirements[' + i +
                '][title]" placeholder="Enter requirement" class="form-control" />  <input type="hidden" name="requirements[' +
                i +
                '][id]" value="" /> </td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });
        $('.deleteReq').click(function(e) {
            e.preventDefault();

            var req_id = $(this).val();
            $('#req_id').val(req_id)
            $('#deleteModal').modal('show');

        });
    </script>

@endsection
