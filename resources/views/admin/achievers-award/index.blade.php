@extends('layouts.admin')

@section('title', 'Achiever\'s Award')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Programs - Achiever's Awardees</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a href="{{ url('admin/achievers-award/overall') }}" class="btn btn-secondary position-relative mr-2"><i
                class="fa-solid fa-user-group fa-sm"></i> Applicants
        </a>
    </div>

    <div class="row">
        @foreach ($courses as $item)
            <div class="col-sm-3 mb-4">
                <a class="card lift h-100" href="{{ url('admin/achievers-award/' . $item->course_code) }}">
                    <div class="card border-left-danger shadow">
                        <div class="card-body text-center">
                            <div class="text-md card-text font-weight-bold text-danger text-uppercase pl-6 mt-4r mt-3">
                                {{ $item->course_code }}
                            </div>
                            <div class="col-12 mb-3">
                                <i class="fas fa-solid fa-award fa-2x text-danger "></i>
                            </div>
                            @if ($item->applicant_count > '0')
                                <div class="position-absolute top-0 end-0 m-2">
                                    <span class="badge bg-danger rounded-circle">{{ $item->applicant_count }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>


@endsection
