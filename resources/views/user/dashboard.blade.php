@extends('layouts.user')

@section('title', 'My Dashboard')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ Auth::user()->first_name }}'s Dashboard</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    @cannot('form application')
        <div class="bd-callout bd-callout-warning bg-white">
            <p class="text-dark">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <b>Award Application is not yet open.</b> (S.Y {{ getAcademicYear() }})
            </p>
        </div>
    @endcan

    @can('form application')
        <div class="card shadow mt-0 mb-4">
            <div class="card-header pt-3 pb-1">
                <p class="text-primary font-weight-bold">Read the award qualifications first before you click any award
                    application button.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                {{-- academic excellenvce --}}
                <div class="card border-left-info shadow mb-4">
                    <img src="{{ asset('uploads/form/' . $acadexcel->photocard) }}" class="card-img-top" alt="image">
                    <div class="card-body text-center">
                        @if ($acad_excell_award_count == '0')
                            <a href="{{ url('user/application-form-ae') }}"
                                class="btn btn-sm btn-outline-primary mb-2 mt-2">ACADEMIC
                                EXCELLENCE
                                AWARD APPLICATION</a>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 mb-2" data-toggle="modal"
                                data-target="#maxNumber">
                                ACADEMIC EXCELLENCE AWARD APPLICATION
                            </button>
                        @endif
                    </div>
                </div>
                {{-- non-academic --}}
                <div class="card border-left-secondary shadow mb-4">
                    <img src="{{ asset('uploads/form/' . $nonacad->photocard) }}" class="card-img-top" alt="image">
                    <div class="card-body text-center">
                        <a href="{{ url('user/non-academic-form') }}"
                            class="btn btn-sm btn-outline-primary mb-2 mt-2">NON-ACADEMIC
                            AWARD APPLICATION</a>
                    </div>
                </div>
                {{-- academic award --}}
                <div class="card border-left-danger shadow mb-4">
                    <img src="{{ asset('uploads/form/' . $acadaward->photocard) }}" class="card-img-top" alt="image">
                    <div class="card-body text-center">
                        @if ($acad_award_count == '0')
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 mb-2" data-toggle="modal"
                                data-target="#exampleModal">ACADEMIC AWARD APPLICATION</button>
                        @else
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2 mb-2" data-toggle="modal"
                                data-target="#maxNumber">
                                ACADEMIC AWARD APPLICATION
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                {{-- Academic Excellence Award --}}
                <div class="card shadow mb-4">
                    <a href="#collapseCard1" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard1">
                        <div class="h6 text-center text-sm font-weight-bold text-success text-uppercase mb-1">
                            Academic Excellence Award Qualifications
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard1">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($acadexcel->requirement as $reqs)
                                    <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                                        &ensp;{{ $reqs->requirements }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- Non-Academic Award --}}
                <div class="card shadow mb-4">
                    <a href="#collapseCard2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard2">
                        <div class="h6 text-center text-sm font-weight-bold text-secondary text-uppercase mb-1">
                            Non-Academic Award Qualifications
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard2">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($nonacad->requirement as $reqs)
                                    <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-secondary"></i>
                                        &ensp;{{ $reqs->requirements }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- Achiever's Award Qualifications --}}
                <div class="card shadow mb-4">
                    <a href="#collapseCard3" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard3">
                        <div class="h6 text-center text-sm font-weight-bold text-danger text-uppercase mb-1">
                            Achiever's Award Qualifications
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard3">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($acadaward->requirement as $reqs)
                                    <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i>
                                        &ensp;
                                        &ensp;{{ $reqs->requirements }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- Dean's List Qualifications --}}
                <div class="card shadow mb-4">
                    <a href="#collapseCard4" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard4">
                        <div class="h6 text-center text-sm font-weight-bold text-info text-uppercase mb-1">
                            Dean's List Qualifications
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard4">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($deans->requirement as $reqs)
                                    <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i>
                                        &ensp;{{ $reqs->requirements }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                {{-- President's List Qualifications --}}
                <div class="card shadow mb-4">
                    <a href="#collapseCard5" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard5">
                        <div class="h6 mb-2 text-center text-sm font-weight-bold text-warning text-uppercase mb-1">
                            President's List Qualifications
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard5">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($presidents->requirement as $reqs)
                                    <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>
                                        &ensp;{{ $reqs->requirements }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @include('user.modals');

@endsection

