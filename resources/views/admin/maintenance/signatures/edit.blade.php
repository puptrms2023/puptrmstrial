@extends('layouts.admin')

@section('title', 'Edit Signature Maintenance')

@section('content')
    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Edit
                        <a href="{{ url('admin/maintenance/signatures') }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/maintenance/signatures/' . $sig->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-12 mb-2">
                                <label class="small">Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control" value="{{ $sig->rep_name }}"
                                    placeholder="Enter name">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="small">Position</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="position" class="form-control"
                                    value="{{ $sig->position }}"placeholder="Enter position">
                                @if ($errors->has('position'))
                                    <span class="text-danger text-left">{{ $errors->first('position') }}</span>
                                @endif
                            </div>
                            <div id="digital_signature" class="col-md-12 mb-2">
                                <label class="small">Signature</label>
                                <br />
                                <div id="signaturePad"></div>
                                <br />
                                <button type="button" id="upload_sig" class="btn btn-sm btn-info">Upload Image
                                    Signature</button>
                                <button id="clear" class="btn btn-success float-right btn-sm">Clear Signature</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                                <input type="hidden" value="{{ $sig->signature }}" name="old_signature">
                            </div>
                            <div id="upload_signature" class="col-md-12 mt-2 hidden">
                                <input type="file" class="form-control" name="image_signature">
                            </div>
                        </div>

                        <button class="btn btn-secondary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    Digital Signature
                    @if ($sig->signature != null)
                        <button class="btn float-right delimage" value="{{ $sig->id }}"><i
                                class="fa-solid fa-trash-can text-danger"></i></button>
                    @endif
                </div>
                <div class="card-body">
                    @if ($sig->signature != null)
                        <img src="{{ asset('uploads/signature/' . $sig->signature) }}" class="mb-2" width="100%"
                            alt="cover">
                    @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User's Signature</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/maintenance/delete-image-signature') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the user's signature?</p>
                        <input type="hidden" name="signature_delete_id" id="signature_id">
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
        // Ensure jQuery is included
        $(document).ready(function() {
            // Initialize signature pad with options
            var signaturePad = $('#signaturePad').signature({
                syncField: '#signature64',
                syncFormat: 'PNG'
            });

            // Add clear signature functionality
            $('#clear').click(function(e) {
                e.preventDefault();
                signaturePad.signature('clear');
                $("#signature64").val('');
            });

            $('.delimage').click(function(e) {
                e.preventDefault();

                var signature_id = $(this).val();
                $('#signature_id').val(signature_id)
                $('#deleteModal').modal('show');

            });
        });
    </script>


@endsection
