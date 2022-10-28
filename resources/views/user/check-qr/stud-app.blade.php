@extends('layouts.user')

@section('title', 'Greetings')

@section('content')

    <div class="row text-center">
        <div class="col-md-12">
            <h1 class="text-uppercase text-primary mt-5">Congratulations!</h1>
            <div class="done mt-4">
                <svg version="1.1" id="tick" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px" y="0px" viewBox="0 0 37 37" style="enable-background:new 0 0 37 37;"
                    xml:space="preserve">
                    <path class="circ path"
                        style="fill:#f1c40f;stroke:#A14A49;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;"
                        d="
	M30.5,6.5L30.5,6.5c6.6,6.6,6.6,17.4,0,24l0,0c-6.6,6.6-17.4,6.6-24,0l0,0c-6.6-6.6-6.6-17.4,0-24l0,0C13.1-0.2,23.9-0.2,30.5,6.5z" />
                    <polyline class="tick path"
                        style="fill:none;stroke:#fff;stroke-width:3;stroke-linejoin:round;stroke-miterlimit:10;"
                        points="
	11.6,20 15.9,24.2 26.4,13.8 " />
                </svg>
            </div>
            <div class="mt-4">
                @if (!empty($user_sa))
                    <p>You have received <b>{{ $user_sa->award->name }}</b> for the School Year
                        {{ $user_sa->school_year }}.<br>
                        Student Number: <b>{{ $user_sa->users->stud_num }}</b><br>
                        Name: <b>{{ $user_sa->users->first_name . ' ' . $user_sa->users->last_name }}</b><br>
                        Course: <b>{{ $user_sa->courses->course }}</b><br>
                        Year: <b>{{ $user_sa->year_level }}</b>
                    </p>
                    <p>Keep Up the Good Work
                    </p>
                @elseif (!empty($user_ae))
                    <p>You have received <b>{{ $user_ae->award->name }}</b> for the School Year
                        {{ $user_ae->school_year }}.<br>
                        Student Number: <b>{{ $user_ae->users->stud_num }}</b><br>
                        Name: <b>{{ $user_ae->users->first_name . ' ' . $user_ae->users->last_name }}</b><br>
                        Course: <b>{{ $user_ae->courses->course }}</b><br>
                        Year: <b>{{ $user_ae->year_level }}</b>
                    @elseif (!empty($user_na))
                    <p>You have received <b>{{ $user_na->nonacad->name }}</b> for the School Year
                        {{ $user_na->school_year }}.<br>
                        Student Number: <b>{{ $user_na->users->stud_num }}</b><br>
                        Name: <b>{{ $user_na->users->first_name . ' ' . $user_na->users->last_name }}</b><br>
                        Course: <b>{{ $user_na->courses->course }}</b><br>
                        Year: <b>{{ $user_na->year_level }}</b>
                @endif
            </div>
        </div>
    </div>
    <div id="confetti-wrapper"></div>

@endsection

@section('scripts')
    <script>
        $(window).on("load", function() {
            setTimeout(function() {
                $('.done').addClass("drawn");
            }, 500);

        });
    </script>
@endsection
