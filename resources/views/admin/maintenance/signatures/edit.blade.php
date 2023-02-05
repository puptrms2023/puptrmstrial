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

                    <form method="POST" action="{{ url('admin/maintenance/signatures/' . $sig->id) }}">
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
                            <div class="col-md-12 mb-2">
                                <label class="small">Signature</label>
                                <br />
                                <div id="signaturePad"></div>
                                <br />
                                <button id="clear" class="btn btn-success float-right btn-sm">Clear Signature</button>
                                <textarea id="signature64" name="signed" style="display: none"></textarea>
                                <input type="hidden" value="{{ $sig->signature }}" name="old_signature">
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
                </div>
                <div class="card-body">
                    <img src="{{ asset('uploads/signature/' . $sig->signature) }}" class="mb-2" width="100%"
                        alt="cover">
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
