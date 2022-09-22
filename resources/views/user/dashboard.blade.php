@extends('layouts.user')

@section('title', 'PUPTAAAS Dashboard')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ Auth::user()->first_name }}'s Dashboard</h1>
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif
    </div>

    <div class="card shadow mt-0 mb-4">
        <div class="card-header pt-3 pb-1">
            <p class="text-primary font-weight-bold">Read the award qualifications first before you click any award
                application button.</p>
        </div>
    </div>

    <div class="form-row mt-0 mb-4 text-center">
        <div class="col-md-12 my-1">


            <a href="{{ url('user/application-form') }}" class="btn btn-outline-primary" button="NA">NON-ACADEMIC AWARD
                APPLICATION</a>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-4">
            <div class="card border-left-danger shadow mb-4">
                <img src="{{ asset('admin/img/acadaward_photocard.jpg') }}" class="card-img-top" alt="image">
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
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i> &ensp;with
                            <b>GWA of 1.75 or above</b> for both first and second semester.
                        </li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i> &ensp;With
                            grades <b>NO LOWER THAN 2.50 IN ALL SUBJECTS</b></li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i>
                            &ensp;Bonafide
                            student of PUP Taguig Branch.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i>
                            &ensp;Officially enrolled for 1st and 2nd semester
                            of the recent academic year.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i>
                            &ensp;Regular
                            Student</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-danger"></i> &ensp;No
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
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-left-info shadow mb-4">
                <img src="{{ asset('admin/img/acadexcellence_photocard.jpg') }}" class="card-img-top" alt="image">
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
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                            &ensp;For
                            Graduating students.
                        </li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                            &ensp;<b>GWA
                                1.75</b> or above from 1st to 4th year.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                            &ensp;With
                            grades <b>NO LOWER THAN 2.50 IN ALL SUBJECTS</b> from 1st year to 4th year.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                            &ensp;Bonafide
                            student of PUP Taguig Branch.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                            &ensp;Officially enrolled for 1st and 2nd semester
                            of the recent academic year.</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                            &ensp;Regular
                            Student from 1st year to 4th year</li>
                        <li class="list-group-item border-0"><i class="fas fa-solid fa-star text-success"></i>
                            &ensp;No
                            Failed, Withdrawn, Incomplete and 'P' remarks in any subject enrolled from 1st to 4th Year
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
