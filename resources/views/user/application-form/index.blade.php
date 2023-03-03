@extends('layouts.user')

@section('title', 'Award Application')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Academic Award Application Form</div>
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
            <form action="{{ url('user/application-form') }}" method="POST" enctype="multipart/form-data"
                id="application_form_aa">
                @csrf

                <div class="card mb-4 border-left-warning">
                    <div class="card-header pt-3 pb-1">
                        <p class="text-primary">Note: P.E. and CWTS subjects cannot be included otherwise your
                            application form will be automatically rejected.</p>
                    </div>
                </div>

                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                            <input type="hidden" value="{{ Auth::user()->course_id }}" name="course_id">
                            <label for="" class="font-weight-bold">Academic Level</label>
                            <span class="text-danger">*</span>
                            <select class="custom-select" name="year_level" id="selectYear" required>
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
                        </div>
                    </div>
                </div>

                <div class="col-xs-4">
                </div>

                {{-- 1st sem --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard1" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard1">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            1st Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard1">
                        <div class="card-body">
                            <table class="table table-sm table-borderless table-responsive">
                                <thead>
                                    <tr>
                                        <th><em>Subject</em> <span class="text-danger">*</span></th>
                                        <th width="20%"><em>Number of Units</em> <span class="text-danger">*</span>
                                        </th>
                                        <th width="20%"><em>Grade</em> <span class="text-danger">*</span></th>
                                        <th><em>Action</em></th>
                                        <th width="20%" style="display:none"><em>Total</em></th>
                                    </tr>
                                </thead>
                                <tbody id="calculation">
                                    @forelse (old('subjects', []) as $i => $subjects)
                                        <tr>
                                            <td>
                                                <select name="subjects[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units[]" value="{{ old('units')[$i] }}"
                                                    class="form-control units multi" id="units" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades[]" value="{{ old('grades')[$i] }}"
                                                    class="form-control grades multi" id="grades"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total[]"
                                                    class="form-control total" id="total"
                                                    value="{{ old('total')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units[]" class="form-control units multi"
                                                    id="units" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades[]" class="form-control grades multi"
                                                    id="grades" onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total[]"
                                                    class="form-control total" id="total" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term" value="1">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit"></small></p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa" name="gwa_1st" value="{{ old('gwa_1st') }}">
                                    @if ($errors->has('gwa_1st'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa_1st') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2nd sem --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard2">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            2nd Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard2">
                        <div class="card-body">
                            <table class="table table-sm table-borderless table-responsive">
                                <thead>
                                    <tr>
                                        <th><em>Subject</em> <span class="text-danger">*</span></th>
                                        <th width="20%"><em>Number of Units</em> <span class="text-danger">*</span>
                                        </th>
                                        <th width="20%"><em>Grade</em> <span class="text-danger">*</span></th>
                                        <th><em>Action</em></th>
                                        <th width="20%" style="display:none"><em>Total</em></th>
                                    </tr>
                                </thead>
                                <tbody id="calculation1">
                                    @forelse (old('subjects1', []) as $i => $subjects1)
                                        <tr>
                                            <td>
                                                <select name="subjects1[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects1 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units1[]" value="{{ old('units1')[$i] }}"
                                                    class="form-control units1 multi1" id="units1" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades1[]" value="{{ old('grades1')[$i] }}"
                                                    class="form-control grades1 multi1" id="grades1"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove1"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total1[]"
                                                    class="form-control total1" id="total1"
                                                    value="{{ old('total1')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects1[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units1[]" class="form-control units1 multi1"
                                                    id="units1" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades1[]"
                                                    class="form-control grades1 multi1" id="grades1"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove1"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total1[]"
                                                    class="form-control total1" id="total1" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term1" value="2">
                            <input type="hidden" id="totalUnits1">
                            <input type="hidden" id="weight1">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn1">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit1"></small>
                            </p>
                            <div class="row mb-3">
                                <label class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa1" name="gwa_2nd" value="{{ old('gwa_2nd') }}">
                                    @if ($errors->has('gwa_2nd'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa_2nd') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-6">
                            <label for="formFile" class="form-label font-weight-bold">AVE GWA:</label>
                            <span id="avg"></span>
                            <div id="result" class="text-primary fw-bold"></div>
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
                <div class="mb-4">
                    <div class="form-check small">
                        <input type="checkbox" class="form-check-input" id="termsCheckbox1">
                        <label class="form-check-label" for="flexCheckDefault">
                            I hereby declare that all information given about is true and correct to the best of my
                            knowledge and ability.
                        </label>
                    </div>
                    <div class="form-check small">
                        <input type="checkbox" class="form-check-input" id="termsCheckbox2">
                        <label class="form-check-label" for="flexCheckDefault">
                            I understand and agree that by filling out this form, I am allowing the recognition committee of
                            the
                            PUP
                            Taguig Recognition Management System to collect, process, use, share and disclose my personal
                            information and also to store it as long as necessary for the fulfillment of the stated purpose
                            and
                            in
                            accordance with applicable laws, including the Data Privacy Act of 2012 and its implementing
                            Rules
                            and
                            Regulations.
                        </label>
                    </div>
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
        var sub = {!! json_encode($sub) !!};
    </script>
@endsection
