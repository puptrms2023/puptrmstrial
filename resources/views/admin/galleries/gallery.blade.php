@extends('layouts.admin')

@section('title', 'Galleries')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header font-weight-bold text-primary">Photo</div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($galleries as $gallery)
                            <div class="col-md-4 mb-2">
                                <div class="hovereffect shadow-sm">
                                    <img class="dark-filter" src="{{ asset('uploads/galleries/' . $gallery->cover) }}"
                                        alt="" width="100%">
                                    <div class="overlay">
                                        <h2 class="font-weight-bold">{{ $gallery->title }}</h2>
                                        <a class="btn btn-sm btn-primary info"
                                            href="{{ url('admin/galleries/show/' . $gallery->id) }}">View
                                            Photos</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bold text-primary">Create New Gallery</div>
                <div class="card-body">
                    <a href="{{ url('admin/galleries/create') }}" class="btn btn-sm btn-block btn-secondary">Create New
                        Gallery</a>
                </div>
            </div>
        </div>
    </div>

@endsection
