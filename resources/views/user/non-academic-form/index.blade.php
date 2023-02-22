@extends('layouts.user')

@section('title', 'Award Application')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Non-Academic Award Application Form</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <b>School Year: <span class="text-primary">{{ getAcademicYear() }}</span></b>
    </div>

    @include('layouts.partials.messages')

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow mt-0 mb-4">
                <div class="card-header pt-3 pb-1">
                    <p class="text-primary font-weight-bold">Student Information</p>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="">Student ID Number:</label>
                        <p class="text-uppercase font-weight-bold">{{ Auth::user()->stud_num }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="">Username:</label>
                        <p class="font-weight-bold">{{ Auth::user()->username }}</p>
                    </div>
                    <div class="mb-3">
                        <label>First Name:</label>
                        <p class="text-uppercase font-weight-bold">{{ Auth::user()->first_name }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Middle Name:</label>
                        <p class="text-uppercase font-weight-bold">{{ Auth::user()->middle_name ?: 'N/A' }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Last Name:</label>
                        <p class="text-uppercase font-weight-bold">{{ Auth::user()->last_name }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Contact Number:</label>
                        <p class="text-uppercase font-weight-bold">{{ Auth::user()->contact }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Email:</label>
                        <p class="text-uppercase font-weight-bold">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Course:</label>
                        <p class="text-uppercase font-weight-bold">{{ Auth::user()->courses->course }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <form action="{{ url('user/non-academic-form') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                <input type="hidden" value="{{ Auth::user()->course_id }}" name="course_id">

                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <label for="" class="font-weight-bold">Academic Level</label>
                            <span class="text-danger">*</span>
                            <select class="custom-select" name="year_level">
                                <option value="">--Select Academic Level--</option>
                                <option data-state="1st Year" value="1st Year"
                                    {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                                <option data-state="2nd Year" value="2nd Year"
                                    {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                <option data-state="3rd Year" value="3rd Year"
                                    {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                <option data-state="4th Year" value="4th Year"
                                    {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                                <option data-state="5th Year" value="5th Year"
                                    {{ old('year_level') == '5th Year' ? 'selected' : '' }}>5th Year</option>
                            </select>
                            @if ($errors->has('year_level'))
                                <span class="text-danger text-left">{{ $errors->first('year_level') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @include('user.non-academic-form.leadership')
                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <label for="" class="font-weight-bold">Non-Academic Award</label>
                            <span class="text-danger">*</span>
                            <select class="custom-select nonacadaward" name="nonacad_id" id="non">
                                <option value="">--Select Award--</option>
                                @foreach ($award as $id => $item)
                                    <option value="{{ $id }}" {{ old('nonacad_id') == $id ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('nonacad_id'))
                                <span class="text-danger text-left">{{ $errors->first('nonacad_id') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div id="organization" class="card shadow mt-0 mb-4 hidden">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="" class="font-weight-bold">Student Organization</label>
                                <span class="text-danger">*</span>
                                <select id="org" class="custom-select studentorg" name="org_id">
                                    <option value="">--Select Organization--</option>
                                    @foreach ($organization as $id => $item)
                                        <option value="{{ $id }}" {{ old('org_id') == $id ? 'selected' : '' }}>
                                            {{ $item }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('org_id'))
                                    <span class="text-danger text-left">{{ $errors->first('org_id') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="others" class="card shadow mt-0 mb-4 hidden">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Others:</label>
                                <span class="text-danger">*</span>
                                <input id="others-value" type="text" name="others" class="form-control">
                                @if ($errors->has('others'))
                                    <span class="text-danger text-left">{{ $errors->first('others') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sports" class="card shadow mt-0 mb-4 hidden">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Sports</label>
                                <span class="text-danger">*</span>
                                <input id="sports-value" type="text" name="sports" class="form-control">
                                @if ($errors->has('sports'))
                                    <span class="text-danger text-left">{{ $errors->first('sports') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="outside" class="card shadow mt-0 mb-4 hidden">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Competition Name</label>
                                <span class="text-danger">*</span>
                                <input id="comp-value" type="text" name="competition" class="form-control">
                                @if ($errors->has('competition'))
                                    <span class="text-danger text-left">{{ $errors->first('competition') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Placements</label>
                                <span class="text-danger">*</span>
                                <input id="placement-value" type="text" name="placement" class="form-control">
                                @if ($errors->has('placement'))
                                    <span class="text-danger text-left">{{ $errors->first('placement') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="subject_name" class="card shadow mt-0 mb-4 hidden">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Subject Name</label>
                                <span class="text-danger">*</span>
                                <input id="subject-value" type="text" name="subject" class="form-control">
                                @if ($errors->has('subject'))
                                    <span class="text-danger text-left">{{ $errors->first('subject') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="thesis" class="card shadow mt-0 mb-4 hidden">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Thesis Title</label>
                                <span class="text-danger">*</span>
                                <textarea id="thesis-value" class="form-control" name="thesis" rows="3"></textarea>
                                @if ($errors->has('thesis'))
                                    <span class="text-danger text-left">{{ $errors->first('thesis') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div id="sa" class="card shadow mt-0 mb-4 hidden">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Designated Office</label>
                                <span class="text-danger">*</span>
                                <input id="designation-value" type="text" name="designation" class="form-control">
                                @if ($errors->has('designation'))
                                    <span class="text-danger text-left">{{ $errors->first('designation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-6 mb-3">
                            <label for="formFile" class="form-label font-weight-bold">Supporting Documents: </label>
                            <span class="text-danger">*</span>
                            <input type="file" name="file" required>
                        </div>
                    </div>
                </div>
                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-6 mb-3">
                            <label for="formFile" class="form-label font-weight-bold">2x2 photo: </label>
                            <span class="text-danger">*</span>
                            <input type="file" name="image" required>
                        </div>
                    </div>
                </div>
                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Remarks <span
                                        class="font-weight-normal">(Optional)</span></label>
                                <textarea class="form-control" name="remarks" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-check small mb-4">
                    <input type="checkbox" class="form-check-input" id="termsCheckbox">
                    <label class="form-check-label" for="flexCheckDefault">
                        I understand and agree that by filling out this form, I am allowing the recognition committee of the
                        PUP
                        Taguig Recognition Management System to collect, process, use, share and disclose my personal
                        information and also to store it as long as necessary for the fulfillment of the stated purpose and
                        in
                        accordance with applicable laws, including the Data Privacy Act of 2012 and its implementing Rules
                        and
                        Regulations.
                    </label>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary" id="form_submit">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var award = document.getElementById('non');
            var orgs = document.getElementById('org');

            if (orgs.value == "9") {
                $("#others").removeClass("hidden");
                $("#others").addClass("show");
            } else {
                $("#others").removeClass("show");
                $("#others").addClass("hidden");
            }

            if (award.value == "1") {
                $("#organization").removeClass("hidden");
                $("#organization").addClass("show");
            } else {
                $("#organization").removeClass("show");
                $("#organization").addClass("hidden");
            }
            if (award.value == "2") {
                $("#sports").removeClass("hidden");
                $("#sports").addClass("show");
            } else {
                $("#sports").removeClass("show");
                $("#sports").addClass("hidden");
            }
            if (award.value == "4") {
                $("#subject_name").removeClass("hidden");
                $("#subject_name").addClass("show");
                $("#thesis").removeClass("hidden");
                $("#thesis").addClass("show");
            } else {
                $("#subject_name").removeClass("show");
                $("#subject_name").addClass("hidden");
                $("#thesis").removeClass("show");
                $("#thesis").addClass("hidden");
            }
            if (award.value == "6") {
                $("#sa").removeClass("hidden");
                $("#sa").addClass("show");
            } else {
                $("#sa").removeClass("show");
                $("#sa").addClass("hidden");
            }
            if (award.value == "7") {
                $("#outside").removeClass("hidden");
                $("#outside").addClass("show");
            } else {
                $("#outside").removeClass("show");
                $("#outside").addClass("hidden");
            }
            if (award.value == "1" || award.value == "3" || award.value == "5" || award.value == "6" || award
                .value == "7") {
                $("#organization").removeClass("hidden");
                $("#organization").addClass("show");
            } else {
                $("#organization").removeClass("show");
                $("#organization").addClass("hidden");
            }
            if (award.value == "2" || award.value == "3") {
                $("#sports").removeClass("hidden");
                $("#sports").addClass("show");
            } else {
                $("#sports").removeClass("show");
                $("#sports").addClass("hidden");
            }
        });
    </script>
@endsection
