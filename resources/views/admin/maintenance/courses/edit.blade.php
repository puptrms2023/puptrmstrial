@extends('layouts.admin')

@section('title', 'Edit Program')

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Edit Program
                        <a href="{{ url('admin/maintenance/programs') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/maintenance/programs/' . $program->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label class="small">Code</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="program_code" class="form-control"
                                    value="{{ $program->course_code }}" placeholder="Program code">
                                @if ($errors->has('program_code'))
                                    <span class="text-danger text-left">{{ $errors->first('program_code') }}</span>
                                @endif
                            </div>

                            <div class="col-md-9 mb-3">
                                <label class="small">Program Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="program" class="form-control"
                                    value="{{ $program->course }}"placeholder="Program name">
                                @if ($errors->has('program'))
                                    <span class="text-danger text-left">{{ $errors->first('program') }}</span>
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
