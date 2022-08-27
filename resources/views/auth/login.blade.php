@extends('layouts.auth-master')

@section('main-content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-md-9 col-lg-12">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row wrap d-md-flex">
                        <div class="img col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-left">
                                    <h3 class="text-gray-900 mb-4">Log In</h3>
                                </div>

                                @include('layouts.partials.messages')

                                <form method="post" action="{{ route('login') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                    <div class="form-group mb-3">
                                        <label class="label" for="name">Username</label>
                                        <input type="text" name="username" class="form-control"
                                            placeholder="Enter your username" value="{{ old('username') }}" required
                                            autofocus>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="label" for="password">Password</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter your password" value="{{ old('password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="form-control btn btn-primary rounded submit px-3 btn-primary">
                                            Sign In
                                        </button>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="custom-control custom-checkbox float-left">
                                            <input type="checkbox" class="custom-control-input" id="customCheck"
                                                name="remember" {{ old('remember') ? 'checked' : '' }} />
                                            <label class="custom-control-label" for="customCheck">Remember me</label>
                                        </div>
                                        <div class="forgot float-right">
                                            <a class="text-decoration-none" href="#" id="forgot-link">Forgot
                                                Password?</a>
                                        </div>
                                    </div>
                                </form>
                                <div class="text-center">
                                    Do not have an account? <a class="text-decoration-none"
                                        href="{{ route('register') }}">Sign Up</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- @include('auth.partials.copy') --}}
        </div>
    </div>
</div>

@endsection