@extends('layouts.admin')

@section('title', 'Create User')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Create New Gallery
                        <a href="{{ url('admin/galleries') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')
                    <form method="POST" action="{{ url('admin/galleries') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="title">Gallery Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="cover">Gallery Cover</label>
                                <input type="file" name="cover" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="description">Gallery Description</label>
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
