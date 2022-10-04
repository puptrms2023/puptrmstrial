@extends('layouts.app')

@section('main-content')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h5 class="text-gray-900 mb-2">Forgot Your Password?</h5>
                                <p class="mb-4"> Enter your email address below and we'll send you a link to reset
                                    your password.
                                </p>
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @include('layouts.partials.messages')

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="row mb-3">

                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="email" class="text-primary font-weight-bold">Email
                                                Address</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-block btn-primary">
                                            Send Password Reset Link
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="text-center">
                                Do not have an account? <a class="text-decoration-none" href="{{ route('register') }}">Sign
                                    Up</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
