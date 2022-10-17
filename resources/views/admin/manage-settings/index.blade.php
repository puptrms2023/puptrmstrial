@extends('layouts.admin')

@section('page_title', 'Manage System Settings')

@section('content')

    <div class="row">
        <div class="col-xl-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Update System Settings
                    </div>
                </div>

                <div class="card-body">

                    @include('layouts.partials.messages')

                    <form enctype="multipart/form-data" method="POST"
                        action="{{ url('admin/update-settings/' . $setting->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group row">
                                    <label class="col-lg-3 text-gray font-weight-bold">System Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="system_name" value="{{ $setting->system_name }}"
                                            class="form-control" placeholder="System Name" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="session_year" class="col-lg-3 text-gray font-weight-bold">Current
                                        Session <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select data-placeholder="Choose..." name="session_year" id="session_year"
                                            class="form-select" required>
                                            <option value=""></option>
                                            @for ($y = date('Y', strtotime('- 3 years')); $y <= date('Y', strtotime('+ 1 years')); $y++)
                                                <option
                                                    {{ $setting->session_year == ($y -= 1) . '-' . ($y += 1) ? 'selected' : '' }}>
                                                    {{ ($y -= 1) . '-' . ($y += 1) }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-gray font-weight-bold">System Acronym <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="system_title" value="{{ $setting->system_title }}"
                                            class="form-control" placeholder="System Acronym" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-gray font-weight-bold"> Phone <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="phone" value="{{ $setting->phone }}"
                                            class="form-control" placeholder="Phone" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-gray font-weight-bold"> Email <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="email" name="email" value="{{ $setting->email }}"
                                            class="form-control" placeholder="Email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-gray font-weight-bold">Address <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input type="text" name="address" value="{{ $setting->address }}"
                                            class="form-control" placeholder="Address" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-gray font-weight-bold">Logo <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <div class="mb-3">
                                            <img style="width: 100px" height="100px"
                                                src="{{ asset('admin/img/' . $setting->logo) }}" alt="">
                                        </div>
                                        <input type="file" class="form-control" name="logo">
                                        <input type="hidden" value="{{ $setting->logo }}" name="old_logo">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 text-gray font-weight-bold">Favicon <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <div class="mb-3">
                                            <img style="width: 32px" height="32px"
                                                src="{{ asset('admin/img/' . $setting->icon) }}" alt="">
                                        </div>
                                        <input type="file" class="form-control" name="icon">
                                        <input type="hidden" value="{{ $setting->logo }}" name="old_icon">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-left">
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- Settings Edit Ends --}}

@endsection
