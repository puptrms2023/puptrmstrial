@extends('layouts.admin')

@section('title','View Users')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="h3 mb-0 text-gray-800">Courses - Dean's List</div>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
</div>

<div class="row">
    @foreach ($courses as $item)
    <div class="col-sm-3 mb-4">
        <a class="card lift h-100" href="{{ url('admin/deans-list-award/'.$item->course_code) }}">
            <div class="card border-left-info shadow">
                <img src="{{ asset('admin/img/bgimage7.jpg') }}" class="card-img-top" alt="image">
                <div class="card-body text-center">
                    <div class="text-md card-text font-weight-bold text-info text-uppercase pl-6 mt-4r mt-3">
                        {{ $item->course_code }}
                    </div>
                    <div class="col-12 mb-3">
                        <i class="fas fa-solid fa-award fa-2x text-info "></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>


@endsection
