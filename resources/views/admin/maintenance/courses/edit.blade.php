@extends('layouts.admin')

@section('title', 'Edit Course')

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Edit Course
                        <a href="{{ url('admin/maintenance/courses') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/maintenance/courses/' . $course->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="small">Code</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="course_code" class="form-control"
                                    value="{{ $course->course_code }}" placeholder="Enter code">
                                @if ($errors->has('course_code'))
                                    <span class="text-danger text-left">{{ $errors->first('course_code') }}</span>
                                @endif
                            </div>

                            <div class="col-md-9">
                                <label class="small">Course Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="course" class="form-control"
                                    value="{{ $course->course }}"placeholder="Enter course name">
                                @if ($errors->has('course'))
                                    <span class="text-danger text-left">{{ $errors->first('course') }}</span>
                                @endif
                            </div>
                        </div>

                        <button class="btn btn-secondary" type="submit">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
