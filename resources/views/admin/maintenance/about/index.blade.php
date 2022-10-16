@extends('layouts.admin')

@section('title', 'About')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">About - Maintenance</div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">Details
                        <a class="btn btn-secondary btn-sm float-right" href="{{ url('admin/maintenance/about/preview') }}">
                            Preview</a>
                    </div>
                </div>
                <div class="card-body">

                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/maintenance/about/' . $about->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $about->title }}" class="form-control" />
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="editor" class="form-control" name="description">{{ $about->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: "{{ route('ckeditor.upload') . '?_token=' . csrf_token() }}"
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
