@extends('layouts.admin')

@section('title', 'Add Signature')

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Add Signature
                        <a href="{{ url('admin/maintenance/signatures') }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/maintenance/signature-store') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-12 mb-2">
                                <label class="small">Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') }}"placeholder="Enter name">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="small">Position</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="position" class="form-control"
                                    value="{{ old('position') }}"placeholder="Enter position">
                                @if ($errors->has('position'))
                                    <span class="text-danger text-left">{{ $errors->first('position') }}</span>
                                @endif
                            </div>
                            <div class="col-md-12 mb-2">
                                <label class="small">Signature (Optional)</label>
                                <br />
                                <div id="signaturePad"></div>
                                <br />
                                <button type="button" id="upload_sig" class="btn btn-sm btn-info">Upload Image
                                    Signature</button>
                                <button id="clear" class="btn btn-success float-right btn-sm">Clear Signature</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                            </div>
                            <div id="upload_signature" class="col-md-12 mt-2 hidden">
                                <input type="file" class="form-control" name="image_signature">
                            </div>
                        </div>

                        <button class="btn btn-secondary" type="submit">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        var signaturePad = $('#signaturePad').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });
        $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.signature('clear');
            $("#signature64").val('');
        });
    </script>

@endsection
