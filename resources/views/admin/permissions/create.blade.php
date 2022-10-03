@extends('layouts.admin')

@section('title', 'Create Role')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Add Roles
                        <a href="{{ url('admin/permissions') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/permissions') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="small mb-1">Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter name"
                                    value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
