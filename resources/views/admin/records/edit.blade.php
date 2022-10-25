@extends('layouts.admin')

@section('title', 'Edit Document')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">Edit Document
                        <a href="{{ url('admin/records') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">

                    @include('layouts.partials.messages')

                    <form action="{{ url('admin/records-update/' . $document->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Document Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', isset($document) ? $document->name : '') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <span class="text-danger">*</span>
                            <textarea id="description" name="description" class="form-control ">{{ old('description', isset($document) ? $document->description : '') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="document">File</label>
                            <span class="text-danger">*</span>
                            <div class="needsclick dropzone" id="document-dropzone"></div>
                        </div>
                        <div>
                            <input class="btn btn-secondary" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ url('admin/records/media') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="document_file[]" value="' + response.name + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document_file[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($document) && $document->document_file)
                    var file = {!! json_encode($document->document_file) !!}
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="document_file[]" value="' + file.file_name + '">')
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
