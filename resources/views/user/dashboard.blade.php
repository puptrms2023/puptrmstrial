@extends('layouts.user')

@section('title', 'PUPTRMS Dashboard')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ Auth::user()->first_name }}'s Dashboard</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-header pt-3 pb-1">
            <p class="text-primary font-weight-bold">Read the award qualifications first before you click any award
                application button.</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="card border-left-info shadow mb-4">
                <img src="{{ asset('uploads/form/' . $acadexcel->photocard) }}" class="card-img-top" alt="image">
                <div class="card-body text-center">
                    <a href="{{ url('user/application-form-ae') }}"
                        class="btn btn-sm btn-outline-primary mb-2 mt-2">ACADEMIC
                        EXCELLENCE
                        AWARD APPLICATION</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h6 mb-2 text-center text-sm font-weight-bold text-success text-uppercase mb-1">
                        Academic Excellence Award Qualifications
                    </div>
                    <ul class="list-group">

                        @foreach ($acadexcel->requirements as $v)
                            <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                                &ensp;
                                {{ $v['requirement'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-left-secondary shadow mb-4">
                <img src="{{ asset('uploads/form/' . $nonacad->photocard) }}" class="card-img-top" alt="image">
                <div class="card-body text-center">
                    <a href="{{ url('user/non-academic-form') }}"
                        class="btn btn-sm btn-outline-primary mb-2 mt-2">NON-ACADEMIC
                        AWARD APPLICATION</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h6 mb-2 text-center text-sm font-weight-bold text-secondary text-uppercase mb-1">
                        Non-Academic Award Qualifications
                    </div>
                    <ul class="list-group">
                        @foreach ($nonacad->requirements as $v)
                            <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-secondary"></i>
                                &ensp; {{ $v['requirement'] }}
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-left-danger shadow mb-4">
                <img src="{{ asset('uploads/form/' . $acadaward->photocard) }}" class="card-img-top" alt="image">
                <div class="card-body text-center">
                    <a href="{{ url('user/application-form') }}" class="btn btn-sm btn-outline-primary mt-2 mb-2">
                        ACADEMIC AWARD APPLICATION
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h6 mb-2 text-center text-sm font-weight-bold text-danger text-uppercase mb-1">
                        Achiever's Award Qualifications
                    </div>
                    <ul class="list-group">
                        @foreach ($acadaward->requirements as $v)
                            <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i> &ensp;
                                {{ $v['requirement'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">

        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h6 mb-2 text-center text-sm font-weight-bold text-info text-uppercase mb-1">
                        Dean's List Qualifications
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i> &ensp;<b>2nd
                                to 4th year students</b> are only qualified.
                        </li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i> &ensp;<b>GWA
                                of 1.51 to 1.75</b> for both first and second semester.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i> &ensp;With
                            grades <b>NO LOWER THAN 2.50 IN ALL SUBJECTS</b></li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i>
                            &ensp;Bonafide student of PUP Taguig Branch.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i>
                            &ensp;Officially enrolled for 1st and 2nd semester
                            of the recent academic year.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i>
                            &ensp;Regular
                            Student</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-info"></i> &ensp;No
                            Failed, Withdrawn, Incomplete
                            and 'P' remarks in any subject enrolled for the recent academic year.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="h6 mb-2 text-center text-sm font-weight-bold text-warning text-uppercase mb-1">
                        President's List Qualifications
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>
                            &ensp;<b>2nd
                                to 4th year students</b> are only qualified.
                        </li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>&ensp;<b>GWA
                                of 1.00 to 1.50</b> for both first and second semester.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>
                            &ensp;With
                            grades <b>NO LOWER THAN 2.50 IN ALL SUBJECTS</b></li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>
                            &ensp;Bonafide student of PUP Taguig Branch.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>
                            &ensp;Officially enrolled for 1st and 2nd semester
                            of the recent academic year.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>
                            &ensp;Regular
                            Student</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-warning"></i>
                            &ensp;No
                            Failed, Withdrawn, Incomplete
                            and 'P' remarks in any subject enrolled for the recent academic year.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
