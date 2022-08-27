@extends('layouts.admin')

@section('title','Edit User')

@section('content')

<div class="row">
    <div class="col-xl-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="m-0 font-weight-bold text-primary">Edit User
                    <a href="{{ url('admin/users') }}" class="btn btn-primary btn-sm float-right">Back</a>
                </div>
            </div>
            <div class="card-body">
                @include('layouts.partials.messages')

                <form method="POST" action="{{ url('admin/update-users/'.$user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="small mb-1">Username (how your name will
                            appear to other users on the site)</label>
                        <input class="form-control" name="username" type="text" placeholder="Enter your username"
                            value="{{ $user->username }}" required autofocus>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">First name</label>
                            <input class="form-control" name="first_name" type="text"
                                placeholder="Enter your first name" value="{{ $user->first_name }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Middle name</label>
                            <input class="form-control" name="middle_name" type="text"
                                placeholder="Enter your middle name" value="{{ $user->middle_name }}" />
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Last Name</label>
                            <input class="form-control" name="last_name" type="text" placeholder="Enter your last name"
                                value="{{ $user->last_name }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Phone number</label>
                            <input class="form-control" name="contact" type="tel" placeholder="Enter your phone number"
                                value="{{ $user->contact }}" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="small mb-1">Email address</label>
                        <input class="form-control" name="email" type="email" placeholder="Enter your email address"
                            value="{{ $user->email }}" required autofocus>
                        @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">User ID</label>
                            <input class="form-control" name="stud_num" type="text"
                                placeholder="Enter your user id or student number" value="{{ $user->stud_num }}"
                                required autofocus>
                        </div>

                        <div class="col-md-6">
                            <label class="small mb-1">Course</label>
                            <input class="form-control" name="course" type="text" placeholder="Enter your course"
                                value="{{ $user->course }}" required autofocus>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Role</label>
                            <select class="custom-select my-1 mr-sm-2" name="role_as">
                                <option value="1" {{ $user->role_as == '3' ? 'selected':''}}>Super Admin</option>
                                <option value="1" {{ $user->role_as == '1' ? 'selected':''}}>Admin</option>
                                <option value="2" {{ $user->role_as == '2' ? 'selected':''}}>Officials</option>
                                <option value="0" {{ $user->role_as == '0' ? 'selected':''}}>Student</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection