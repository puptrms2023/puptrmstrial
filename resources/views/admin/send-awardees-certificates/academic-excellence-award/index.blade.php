@extends('layouts.admin')

@section('title', 'Send Certificates')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Academic Excellence - Send Certificates</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        @foreach ($courses as $item)
            <div class="col-sm-3 mb-4">
                <a class="card lift h-100"
                    href="{{ url('admin/send-awardees-certificates/academic-excellence-award/' . $item->course_code) }}">
                    <div class="card border-left-success shadow">
                        {{-- <div class="position-absolute top-0 end-0 mt-2 me-2">
                            <div class="bg-danger rounded-circle text-white d-flex align-items-center justify-content-center"
                                style="width: 20px; height: 20px;">
                                {{ $item->ae_applicants->certificate_status->count() }}
                            </div>
                        </div> --}}
                        <div class="card-body text-center">
                            <div class="text-md card-text font-weight-bold text-success text-uppercase pl-6 mt-4r mt-3">
                                {{ $item->course_code }}
                            </div>
                            <div class="col-12 mb-3">
                                <i class="fas fa-solid fa-award fa-2x text-success "></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>


@endsection
