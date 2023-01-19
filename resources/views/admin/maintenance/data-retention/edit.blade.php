@extends('layouts.admin')

@section('title', 'Edit Data Retention')

@section('content')

    <div class="row">
        <div class="col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Edit Data Retention
                        <a href="{{ route('retention') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ route('retention.update', $data_retention->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">

                            <div class="col-md-12 mb-3">
                                <label class="small"> Name</label>
                                <span class="text-danger">*</span>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $data_retention->name }}">
                                @if ($errors->has('program'))
                                    <span class="text-danger text-left">{{ $errors->first('program') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="small"> Day</label>
                                <span class="text-danger">*</span>
                                <input type="number" name="period" class="form-control" min="1"
                                    value="{{ $data_retention->period }}">
                                @if ($errors->has('program'))
                                    <span class="text-danger text-left">{{ $errors->first('program') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="small"> Duration</label>
                                <span class="text-danger">*</span>
                                <select class="custom-select" name="duration" aria-label="Default select example">
                                    <option value="">--Select--</option>
                                    <option value="Years" {{ $data_retention->duration == 'Years' ? 'selected' : '' }}>
                                        Year(s)</option>
                                    <option value="Months"{{ $data_retention->duration == 'Months' ? 'selected' : '' }}>
                                        Month(s)</option>
                                    <option value="Days" {{ $data_retention->duration == 'Days' ? 'selected' : '' }}>
                                        Days(s)</option>
                                </select>
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
