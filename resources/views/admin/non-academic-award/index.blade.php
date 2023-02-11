@extends('layouts.admin')

@section('title', 'Non Academic Applicants')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Non Academic Award</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a href="{{ url('admin/non-academic-award/all') }}" class="btn btn-secondary position-relative mr-2"><i
                class="fa-solid fa-user-group fa-sm"></i> Applicants
            @if ($total >= 1)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $total }}
                </span>
            @endif
        </a>
    </div>

    <div class="row">
        @foreach ($nonacad as $item)
            <div class="col-lg-3 mb-3 d-flex align-items-stretch">
                <a class="card lift border-left-secondary w-100" href="{{ url('admin/non-academic-award/' . $item->id) }}">
                    <div class="card border-0">
                        <div class="card-body d-flex flex-column text-center">
                            <div class="card-text font-weight-bold text-secondary text-uppercase">
                                {{ $item->name }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
        {{-- @foreach ($nonacad as $item)
            <div class="col-lg-4 mb-3 d-flex align-items-stretch">
                <a class="card lift border-left-secondary " href="{{ url('admin/non-academic-award/' . $item->id) }}">
                    <div class="card border-0">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">Dōtonbori Canal</h5>
                            <p class="card-text mb-4">{{ $item->name }}</p>
                            <a href="#" class="btn btn-primary mt-auto align-self-start">Book now</a>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach --}}
    </div>




@endsection
