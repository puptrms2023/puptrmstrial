@extends('layouts.admin')

@section('title', 'Send Certificates')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Upload New Photo
                        <a href="{{ url('admin/galleries/show/' . $gallery->id) }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')
                    <form method="POST" action="{{ url('admin/galleries/photos/store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="title">Photo Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cover">Photo</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="description">Photo Description</label>
                                <textarea name="description" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-secondary">Create Gallery</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
