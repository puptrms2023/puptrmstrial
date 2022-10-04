@extends('layouts.auth-master')

@section('main-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-5">
                                    <div class="text-left">
                                        <h3 class="text-gray-900 mb-4">Register</h3>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="mb-3">
                                            <label class="small mb-1">Username</label>
                                            <input class="form-control" name="username" type="text"
                                                placeholder="Enter your username" value="{{ old('username') }}" required
                                                autofocus>
                                            @if ($errors->has('username'))
                                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                                            @endif
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1">First name</label>
                                                <input class="form-control" name="first_name" type="text"
                                                    placeholder="Enter your first name" value="{{ old('first_name') }}"
                                                    required autofocus>
                                                @if ($errors->has('first_name'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1">Middle name</label>
                                                <input class="form-control" name="middle_name" type="text"
                                                    placeholder="Enter your middle name" value="{{ old('middle_name') }}" />
                                                @if ($errors->has('middle_name'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('middle_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1">Last Name</label>
                                                <input class="form-control" name="last_name" type="text"
                                                    placeholder="Enter your last name" value="{{ old('last_name') }}"
                                                    required autofocus>
                                                @if ($errors->has('last_name'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1">Phone number</label>
                                                <input class="form-control js-phone" name="contact" type="text"
                                                    placeholder="Enter your phone number"
                                                    value="{{ substr(old('contact'), 3) }}" required autofocus>
                                                @if ($errors->has('contact'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('contact') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="small mb-1">Email address</label>
                                            <input class="form-control" name="email" type="email"
                                                placeholder="Enter your email address" value="{{ old('email') }}" required
                                                autofocus>
                                            @if ($errors->has('email'))
                                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1">Student Number</label>
                                                <input name="stud_num" type="text" class="form-control"
                                                    placeholder="Enter your student number" value="{{ old('stud_num') }}"
                                                    onkeydown="limit(this);" onkeyup="limit(this);" required autofocus>
                                                @if ($errors->has('stud_num'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('stud_num') }}</span>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <label class="small mb-1">Course</label>
                                                <select class="custom-select" name="course_id" id="course_id" required>
                                                    <option value="">--Select Course--</option>
                                                    @foreach ($course as $id => $item)
                                                        <option value="{{ $id }}"
                                                            {{ old('course_id') == $id ? 'selected' : '' }}>
                                                            {{ $item }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('course_id'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('course_id') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row gx-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1">Password</label>
                                                <input class="form-control" name="password" type="password"
                                                    placeholder="Enter new password" value="{{ old('password') }}"
                                                    required>
                                                @if ($errors->has('password'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1">Confirm Password</label>
                                                <input class="form-control" name="password_confirmation" type="password"
                                                    placeholder="Confirm new password"
                                                    value="{{ old('password_confirmation') }}" required>
                                                @if ($errors->has('password_confirmation'))
                                                    <span
                                                        class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                                                @endif
                                            </div>

                                        </div>

                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </form>

                                    <hr>

                                    <div class="text-center">
                                        Already have an account?
                                        <a class="text-decoration-none" href="{{ route('login') }}">
                                            Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- @include('auth.partials.copy') --}}
    </div>
@endsection
