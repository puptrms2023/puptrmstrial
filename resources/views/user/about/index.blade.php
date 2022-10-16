@extends('layouts.user')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">About</div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="mb-2">
                <div class="lead text-gray-800 mb-2">{{ $about->title }}</div>
                <div class="mb-4">{!! $about->description !!}</div>
            </div>
        </div>
    </div>
@endsection
