@extends('layouts.admin')

@section('title', 'Preview')

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">Preview
                        <a class="btn btn-secondary btn-sm float-right" href="{{ url('admin/maintenance/about') }}">
                            Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="mb-2">
                                <div class="lead text-gray-800 mb-2">{{ $about->title }}</div>
                                <div class="mb-4">{!! $about->description !!}</div>
                            </div>
                        </div>
                    </div>
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
                    uploadUrl: '{{ url('admin/maintenance/about/upload') . '?_token=' . csrf_token() }}',
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
