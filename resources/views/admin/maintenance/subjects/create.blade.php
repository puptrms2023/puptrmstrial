@extends('layouts.admin')

@section('title', 'Add Program')

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Add Subject
                        <a href="{{ url('admin/maintenance/subjects') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/maintenance/subjects') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label class="small">Course Code</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="course_code" class="form-control"
                                    value="{{ old('course_code') }}"placeholder="Course code">
                                @if ($errors->has('course_code'))
                                    <span class="text-danger text-left">{{ $errors->first('course_code') }}</span>
                                @endif
                            </div>
                            <div class="col-md-9 mb-3">
                                <label class="small">Course Description</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="course_description" class="form-control"
                                    value="{{ old('course_description') }}"placeholder="Course description">
                                @if ($errors->has('course_description'))
                                    <span class="text-danger text-left">{{ $errors->first('course_description') }}</span>
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
