@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-xl-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Profile
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/update-profile/' . Auth::user()->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Username</label>
                                <input class="form-control" name="username" type="text" placeholder="Enter your username"
                                    value="{{ Auth::user()->username }}" required autofocus>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Email address</label>
                                <input class="form-control" name="email" type="email"
                                    placeholder="Enter your email address" value="{{ Auth::user()->email }}" required
                                    autofocus>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">First name</label>
                                <input class="form-control" name="first_name" type="text"
                                    placeholder="Enter your first name" value="{{ Auth::user()->first_name }}" required
                                    autofocus>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Middle name</label>
                                <input class="form-control" name="middle_name" type="text"
                                    placeholder="Enter your middle name" value="{{ Auth::user()->middle_name }}" />
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1">Last Name</label>
                                <input class="form-control" name="last_name" type="text"
                                    placeholder="Enter your last name" value="{{ Auth::user()->last_name }}" required
                                    autofocus>
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Phone number</label>
                                <input class="form-control js-phone" name="contact" type="text"
                                    placeholder="Enter your phone number" value="{{ substr(Auth::user()->contact, 3) }}"
                                    required autofocus>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
