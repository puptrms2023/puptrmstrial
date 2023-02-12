@extends('layouts.user')

@section('title', 'Academic Excellence Application')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Academic Excellence Application Form</div>
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
            <form action="{{ url('user/application-form-ae') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="card mb-4 border-left-warning">
                    <div class="card-header pt-3 pb-1">
                        <p class="text-primary">Note: P.E. and CWTS subjects cannot be included otherwise your
                            application form will be automatically rejected.</p>
                    </div>
                </div>
                <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                <input type="hidden" value="{{ Auth::user()->course_id }}" name="course_id">

                <div class="card shadow mt-0 mb-4">
                    <div class="card-body">
                        <div class="col-md-12 mb-3">
                            <label for="" class="font-weight-bold">Academic Level</label>
                            <span class="text-danger">*</span>
                            <select class="custom-select 5thyear" name="year_level" id="5thyear_onload" required>
                                <option data-state="4th Year" value="4th Year"
                                    {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                                <option data-state="5th Year" value="5th Year"
                                    {{ old('year_level') == '5th Year' ? 'selected' : '' }}>5th Year</option>
                            </select>
                        </div>
                    </div>
                </div>
                {{-- 1st year 1st term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard1" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard1">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            1st Year - 1st Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard1">
                        <div class="card-body">
                            <table class="table table-sm table-borderless table-responsive">
                                <thead>
                                    <tr>
                                        <th><em>Subject</em> <span class="text-danger">*</span></th>
                                        <th width="20%"><em>Number of Units</em> <span class="text-danger">*</span></th>
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
                                        id="gwa" name="gwa1" value="{{ old('gwa1') }}">
                                    @if ($errors->has('gwa1'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa1') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 1st year 2nd term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard2" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard2">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            1st Year - 2nd Semester
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
                                        id="gwa1" name="gwa2" value="{{ old('gwa2') }}">
                                    @if ($errors->has('gwa2'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa2') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2nd year 1st term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard3" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard3">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Second Year - 1st Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard3">
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
                                <tbody id="calculation3">
                                    @forelse (old('subjects3', []) as $i => $subjects3)
                                        <tr>
                                            <td>
                                                <select name="subjects3[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects3 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units3[]" value="{{ old('units3')[$i] }}"
                                                    class="form-control units3 multi3" id="units3" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades3[]" value="{{ old('grades3')[$i] }}"
                                                    class="form-control grades3 multi3" id="grades3"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total3[]"
                                                    class="form-control total3" id="total3"
                                                    value="{{ old('total3')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects3[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units3[]" class="form-control units3 multi3"
                                                    id="units3" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades3[]"
                                                    class="form-control grades3 multi3" id="grades3"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove3"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total3[]"
                                                    class="form-control total3" id="total3" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term3" value="3">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits3">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight3">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn3">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit3"></small>
                            </p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa3" name="gwa3" value="{{ old('gwa3') }}">
                                    @if ($errors->has('gwa3'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa3') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2nd year 2nd term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard4" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard4">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Second Year - 2nd Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard4">
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
                                <tbody id="calculation4">
                                    @forelse (old('subjects4', []) as $i => $subjects4)
                                        <tr>
                                            <td>
                                                <select name="subjects4[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects4 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units4[]" value="{{ old('units4')[$i] }}"
                                                    class="form-control units4 multi4" id="units4" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 14) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades4[]" value="{{ old('grades4')[$i] }}"
                                                    class="form-control grades4 multi4" id="grades4"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total4[]"
                                                    class="form-control total4" id="total4"
                                                    value="{{ old('total4')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects4[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units4[]" class="form-control units4 multi4"
                                                    id="units4" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 14) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades4[]"
                                                    class="form-control grades4 multi4" id="grades4"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove4"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total4[]"
                                                    class="form-control total4" id="total4" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term4" value="4">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits4">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight4">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn4">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit4"></small>
                            </p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa4" name="gwa4" value="{{ old('gwa4') }}">
                                    @if ($errors->has('gwa4'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa4') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 3rd Year 1st Term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard5" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard5">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Third Year - 1st Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard5">
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
                                <tbody id="calculation5">
                                    @forelse (old('subjects5', []) as $i => $subjects5)
                                        <tr>
                                            <td>
                                                <select name="subjects5[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects5 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units5[]" value="{{ old('units5')[$i] }}"
                                                    class="form-control units5 multi5" id="units5" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades5[]" value="{{ old('grades5')[$i] }}"
                                                    class="form-control grades5 multi5" id="grades5"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total5[]"
                                                    class="form-control total5" id="total5"
                                                    value="{{ old('total5')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects5[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units5[]" class="form-control units5 multi5"
                                                    id="units5" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades5[]"
                                                    class="form-control grades5 multi5" id="grades5"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove5"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total5[]"
                                                    class="form-control total5" id="total5" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term5" value="5">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits5">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight5">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn5">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit5"></small>
                            </p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa5" name="gwa5" value="{{ old('gwa5') }}">
                                    @if ($errors->has('gwa5'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa5') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 3rd Year 2nd Term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard6" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard6">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Third Year - 2nd Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard6">
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
                                <tbody id="calculation6">
                                    @forelse (old('subjects6', []) as $i => $subjects6)
                                        <tr>
                                            <td>
                                                <select name="subjects6[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects6 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units6[]" value="{{ old('units6')[$i] }}"
                                                    class="form-control units6 multi6" id="units6" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 16) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades6[]" value="{{ old('grades6')[$i] }}"
                                                    class="form-control grades6 multi6" id="grades6"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total6[]"
                                                    class="form-control total6" id="total6"
                                                    value="{{ old('total6')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects6[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units6[]" class="form-control units6 multi6"
                                                    id="units6" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 16) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades6[]"
                                                    class="form-control grades6 multi6" id="grades6"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove6"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total6[]"
                                                    class="form-control total6" id="total6" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term6" value="6">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits6">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight6">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn6">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit6"></small>
                            </p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa6" name="gwa6" value="{{ old('gwa6') }}">
                                    @if ($errors->has('gwa6'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa6') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 4th Year 1st Term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard7" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard7">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Fourth Year - 1st Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard7">
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
                                <tbody id="calculation7">
                                    @forelse (old('subjects7', []) as $i => $subjects7)
                                        <tr>
                                            <td>
                                                <select name="subjects7[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects7 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units7[]" value="{{ old('units7')[$i] }}"
                                                    class="form-control units7 multi7" id="units7" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 17) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades7[]" value="{{ old('grades7')[$i] }}"
                                                    class="form-control grades7 multi7" id="grades7"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total7[]"
                                                    class="form-control total7" id="total7"
                                                    value="{{ old('total7')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects7[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units7[]" class="form-control units7 multi7"
                                                    id="units7" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 17) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades7[]"
                                                    class="form-control grades7 multi7" id="grades7"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove7"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total7[]"
                                                    class="form-control total7" id="total7" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term7" value="7">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits7">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight7">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn7">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit7"></small>
                            </p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-7">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa7" name="gwa7" value="{{ old('gwa7') }}">
                                    @if ($errors->has('gwa7'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa7') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 4th Year 2nd Term --}}
                <div class="card shadow mt-0 mb-4">
                    <a href="#collapseCard8" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard8">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Fourth Year - 2nd Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard8">
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
                                <tbody id="calculation8">
                                    @forelse (old('subjects8', []) as $i => $subjects8)
                                        <tr>
                                            <td>
                                                <select name="subjects8[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects8 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units8[]" value="{{ old('units8')[$i] }}"
                                                    class="form-control units8 multi8" id="units8" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 18) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades8[]" value="{{ old('grades8')[$i] }}"
                                                    class="form-control grades8 multi8" id="grades8"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total8[]"
                                                    class="form-control total8" id="total8"
                                                    value="{{ old('total8')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects8[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub" required>
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units8[]" class="form-control units8 multi8"
                                                    id="units8" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 18) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false" required>
                                            </td>
                                            <td><input type="text" name="grades8[]"
                                                    class="form-control grades8 multi8" id="grades8"
                                                    onkeypress="return isFloatNumber(this,event)" required>
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove8"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total8[]"
                                                    class="form-control total8" id="total8" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term8" value="8">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits8">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight8">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn8">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit8"></small>
                            </p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa8" name="gwa8" value="{{ old('gwa8') }}">
                                    @if ($errors->has('gwa8'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa8') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 5th year 1st sem --}}
                <div id="5th_1" class="card shadow mt-0 mb-4 hidden">
                    <a href="#collapseCard9" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard9">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Fifth Year - 1st Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard9">
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
                                <tbody id="calculation10">
                                    @forelse (old('subjects10', []) as $i => $subjects10)
                                        <tr>
                                            <td>
                                                <select name="subjects10[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub">
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects10 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units10[]" value="{{ old('units10')[$i] }}"
                                                    class="form-control units10 multi10" id="units10" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false">
                                            </td>
                                            <td><input type="text" name="grades10[]"
                                                    value="{{ old('grades10')[$i] }}"
                                                    class="form-control grades10 multi10" id="grades10"
                                                    onkeypress="return isFloatNumber(this,event)">
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove10"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total10[]"
                                                    class="form-control total10" id="total10"
                                                    value="{{ old('total10')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects10[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub">
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units10[]"
                                                    class="form-control units10 multi10" id="units10" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false">
                                            </td>
                                            <td><input type="text" name="grades10[]"
                                                    class="form-control grades10 multi10" id="grades10"
                                                    onkeypress="return isFloatNumber(this,event)">
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove10"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total10[]"
                                                    class="form-control total10" id="total10" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term10" value="10">
                            <input type="hidden" id="totalUnits10">
                            <input type="hidden" id="weight10">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn10">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit10"></small>
                            </p>
                            <div class="row mb-3">
                                <label class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa10" name="gwa10" value="{{ old('gwa10') }}">
                                    @if ($errors->has('gwa10'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa10') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 5th year - 2nd sem --}}
                <div id="5th_2" class="card shadow mt-0 mb-4 hidden">
                    <a href="#collapseCard10" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard10">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Fifth Year - 2nd Semester
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard10">
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
                                <tbody id="calculation11">
                                    @forelse (old('subjects11', []) as $i => $subjects11)
                                        <tr>
                                            <td>
                                                <select name="subjects11[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub">
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects11 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units11[]"
                                                    value="{{ old('units11')[$i] }}"
                                                    class="form-control units11 multi11" id="units11" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false">
                                            </td>
                                            <td><input type="text" name="grades11[]"
                                                    value="{{ old('grades11')[$i] }}"
                                                    class="form-control grades11 multi11" id="grades11"
                                                    onkeypress="return isFloatNumber(this,event)">
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove11"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total11[]"
                                                    class="form-control total11" id="total11"
                                                    value="{{ old('total11')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects11[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub">
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units11[]"
                                                    class="form-control units11 multi11" id="units11" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false">
                                            </td>
                                            <td><input type="text" name="grades11[]"
                                                    class="form-control grades11 multi11" id="grades11"
                                                    onkeypress="return isFloatNumber(this,event)">
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove11"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total11[]"
                                                    class="form-control total11" id="total11" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term11" value="11">
                            <input type="hidden" id="totalUnits11">
                            <input type="hidden" id="weight11">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn11">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit11"></small>
                            </p>
                            <div class="row mb-3">
                                <label class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-6">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa11" name="gwa11" value="{{ old('gwa11') }}">
                                    @if ($errors->has('gwa11'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa11') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- summer --}}
                <div class="col-md-6 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="summerchk" id="chkSummer"
                            onchange="toggleStatus()">
                        <label class="form-check-label" for="flexCheckChecked">
                            Summer Subjects
                        </label>
                    </div>
                </div>

                {{-- summer subject --}}

                <div id="dvSummer" class="card shadow mt-0 mb-4 hidden">
                    <a href="#collapseCard11" class="d-block card-header py-3" data-toggle="collapse" role="button"
                        aria-expanded="true" aria-controls="collapseCard11">
                        <div class="h6 text-sm font-weight-bold text-primary text-uppercase mb-1">
                            Summer
                        </div>
                    </a>
                    <div class="collapse show" id="collapseCard11">
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
                                <tbody id="calculation9">
                                    @forelse (old('subjects9', []) as $i => $subjects9)
                                        <tr>
                                            <td>
                                                <select name="subjects9[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub">
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $subjects9 == $item->id ? 'selected' : '' }}>
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units9[]"
                                                    value="{{ old('units9')[$i] }}" class="form-control units9 multi9"
                                                    id="units9" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 18) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false">
                                            </td>
                                            <td><input type="text" name="grades9[]"
                                                    value="{{ old('grades9')[$i] }}"
                                                    class="form-control grades9 multi9" id="grades9"
                                                    onkeypress="return isFloatNumber(this,event)">
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total9[]"
                                                    class="form-control total9" id="total9"
                                                    value="{{ old('total9')[$i] }}" readonly>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>
                                                <select name="subjects9[]" data-placeholder="Select subject"
                                                    data-allow-clear="1" class="selectsub">
                                                    <option selected="selected"></option>
                                                    @foreach ($sub as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->s_code }} - {{ $item->s_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="units9[]"
                                                    class="form-control units9 multi9" id="units9" min="1"
                                                    onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 18) ? null : event.charCode >= 48 && event.charCode <= 57"
                                                    onpaste="return false">
                                            </td>
                                            <td><input type="text" name="grades9[]"
                                                    class="form-control grades9 multi9" id="grades9"
                                                    onkeypress="return isFloatNumber(this,event)">
                                            </td>
                                            <td><button type="button" class="btn btn-secondary" id="remove9"><i
                                                        class="fa-solid fa-circle-minus"></i></button></td>
                                            <td style="display:none"><input type="text" name="total9[]"
                                                    class="form-control total9" id="total9" readonly>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <input type="hidden" name="term9" value="9">
                            <input type="hidden" name="tu" value="{{ old('tu') }}" id="totalUnits9">
                            <input type="hidden" name="w" value="{{ old('w') }}" id="weight9">
                            <div class="mb-3">
                                <button type="button" class="btn btn-primary" id="add_btn9">Add Subject</button>
                            </div>
                            <p class="text-muted"><small>Total Number of Units: </small><small id="totalUnit9"></small>
                            </p>
                            <div class="row">
                                <label for="inputEmail" class="col-auto col-form-label">GWA:</label>
                                <div class="col-sm-9">
                                    <input type="text" readonly class="form-control-plaintext font-weight-bold"
                                        id="gwa9" name="gwa9" value="{{ old('gwa9') }}">
                                    @if ($errors->has('gwa9'))
                                        <span class="text-danger text-left">{{ $errors->first('gwa9') }}</span>
                                    @endif
                                </div>
                            </div>
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
        var sub = {!! json_encode($sub) !!};
        document.addEventListener('DOMContentLoaded', (event) => {
            var year = document.getElementById('5thyear_onload');
            if (year.value == "5th Year") {
                $("#5th_1").removeClass("hidden");
                $("#5th_1").addClass("show");
                $("#5th_2").removeClass("hidden");
                $("#5th_2").addClass("show");
            } else {
                $("#5th_1").removeClass("show");
                $("#5th_1").addClass("hidden");
                $("#5th_2").removeClass("show");
                $("#5th_2").addClass("hidden");
            }
        });
    </script>

@endsection
