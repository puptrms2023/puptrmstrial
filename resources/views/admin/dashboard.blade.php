@extends('layouts.admin')

@section('title','PUPT RMS Dashboard')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
</div>
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
<!-- Content Row -->
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <a class="card lift h-100" href="{{url('admin/achievers-award')}}">
            <div class="card-body border-left-danger d-flex justify-content-center flex-column">
                <div class="row no-gutters align-items-center text-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-danger text-uppercase mb-1 ">
                            Achiever's Award Applications</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">First year students</div>
                    </div>
                    <div class="col-12">
                        <i class="fas fa-solid fa-award fa-2x text-danger"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <a class="card lift h-100" href="{{url('admin/deans-list-award')}}">
            <div class="card-body border-left-info d-flex justify-content-center flex-column">
                <div class="row no-gutters align-items-center text-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-info text-uppercase mb-1 ">
                            Dean's List Applications</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Second to Fourth year students</div>
                    </div>
                    <div class="col-12">
                        <i class="fas fa-solid fa-award fa-2x text-info"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <a class="card lift h-100" href="{{url('admin/presidents-list-award')}}">
            <div class="card-body border-left-success d-flex justify-content-center flex-column">
                <div class="row no-gutters align-items-center text-center">
                    <div class="col mr-2">
                        <div class="text-md font-weight-bold text-success text-uppercase mb-1 ">
                            President's List Applications</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Second to Fourth year students</div>
                    </div>
                    <div class="col-12">
                        <i class="fas fa-solid fa-award fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection
