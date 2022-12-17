@extends('layouts.admin')

@section('title', 'Student Info')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800"> Academic Excellence Applicant
        </div>
    </div>

    @include('layouts.partials.messages')

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">
                        Student Information
                        <a href="{{ url('admin/academic-excellence-award/' . $status->courses->course_code) }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th width="25%">Student Number</th>
                                <td>{{ $status->users->stud_num }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Student Name</th>
                                <td>{{ $status->users->first_name . ' ' . $status->users->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td>{{ $status->courses->course }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Year Level</th>
                                <td>{{ $status->year_level }}</td>
                            </tr>
                            <tr>
                                <th width="25%">School Year</th>
                                <td><b>{{ $status->school_year }}</b></td>
                            </tr>
                            <tr>
                                <th width="25%">GWA</th>
                                <td class="font-weight-bold text-primary">
                                    @if (!empty($status->gwa9) && empty($status->gwa10))
                                        {{ number_format((float) $totalwithSummer, 2, '.', '') }}
                                    @elseif(!empty($status->gwa10 || $status->gwa11) && empty($status->gwa9))
                                        {{ number_format((float) $totalwith5thYear, 2, '.', '') }}
                                    @elseif(!empty($status->gwa9 && $status->gwa10))
                                        {{ number_format((float) $totalwith5thAndSummer, 2, '.', '') }}
                                    @else
                                        {{ $status->gwa }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th width="25%">2x2 photo</th>
                                <td>
                                    <img src="{{ asset('uploads/' . $status->image) }}" alt="" width="150px"
                                        height="150px">
                                </td>
                            </tr>
                            <tr>
                                <th width="25%">Status</th>
                                <td>
                                    @if ($status->status == '0')
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                    @if ($status->status == '1')
                                        <span class="badge badge-success">Approved</span>
                                    @endif
                                    @if ($status->status == '2')
                                        <span class="badge badge-danger">Rejected</span>
                                        @if ($status->reason != '')
                                            <small> - {{ $status->reason }}</small>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="float-right"> Added at {{ $status->created_at }} </small>
                </div>
            </div>
        </div>
    </div>
    {{-- 1st year --}}
    <p>FIRST YEAR</p>
    <div class="row mb-2">
        {{-- First Year - 1st Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">1st Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
        {{-- First Year - 2nd Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">2nd Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades2 as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 2nd year --}}
    <p>SECOND YEAR</p>
    <div class="row mb-2">
        {{-- Second Year - 1st Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">1st Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades3 as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
        {{-- Second Year - 2nd Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">2nd Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades4 as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 3rd year --}}
    <p>THIRD YEAR</p>
    <div class="row mb-2">
        {{-- Third Year - 1st Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">1st Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades5 as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
        {{-- Third Year - 2nd Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">2nd Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades6 as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 4th year --}}
    <p>FOURTH YEAR</p>
    <div class="row mb-2">
        {{-- Fourth Year - 1st Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">1st Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades7 as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fourth Year - 2nd Sem --}}
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">2nd Semester Grades
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Grades</th>
                                    <th>Units</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $gwa = 0;
                                    $units = 0;
                                    $total = 0;
                                @endphp
                                @foreach ($grades8 as $grade)
                                    <tr>
                                        <td>{{ $grade->subjects }}</td>
                                        <td>{{ $grade->grades }}</td>
                                        <td>{{ $grade->units }}</td>
                                    </tr>
                                    @php
                                        $units += $grade->units;
                                        $total += $grade->grades * $grade->units;
                                        $gwa = $total / $units;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <small>GWA: <b>{{ $gwa }}</b></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 4th year --}}

    @if (count($grades10) > 0 || count($grades11) > 0)
        {{-- 5th year --}}
        <p>FIFTH YEAR</p>
        <div class="row mb-2">
            {{-- Fifth Year - 1st Sem --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="m-0 font-weight-bold text-primary">1st Semester Grades
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Grades</th>
                                        <th>Units</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $gwa = 0;
                                        $units = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($grades10 as $grade)
                                        <tr>
                                            <td>{{ $grade->subjects }}</td>
                                            <td>{{ $grade->grades }}</td>
                                            <td>{{ $grade->units }}</td>
                                        </tr>
                                        @php
                                            $units += $grade->units;
                                            $total += $grade->grades * $grade->units;
                                            $gwa = $total / $units;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <small>GWA: <b>{{ $gwa }}</b></small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Fifth Year - 2nd Sem --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="m-0 font-weight-bold text-primary">2nd Semester Grades
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Grades</th>
                                        <th>Units</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $gwa = 0;
                                        $units = 0;
                                        $total = 0;
                                    @endphp
                                    @foreach ($grades11 as $grade)
                                        <tr>
                                            <td>{{ $grade->subjects }}</td>
                                            <td>{{ $grade->grades }}</td>
                                            <td>{{ $grade->units }}</td>
                                        </tr>
                                        @php
                                            $units += $grade->units;
                                            $total += $grade->grades * $grade->units;
                                            $gwa = $total / $units;
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <small>GWA: <b>{{ $gwa }}</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($grades9->count() > 0)
        <p>SUMMER</p>
        <div class="row mb-2">
            {{-- Fourth Year - 1st Sem --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="m-0 font-weight-bold text-primary">Summer Grades
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Grades</th>
                                        <th>Units</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grades9 as $grade)
                                        <tr>
                                            <td>{{ $grade->subjects }}</td>
                                            <td>{{ $grade->grades }}</td>
                                            <td>{{ $grade->units }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <small>GWA: <b>{{ $status->gwa9 }}</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @can('acad excellence edit')
        <div class="row">
            <div class="col-md-6">
                <form
                    action="{{ url('admin/academic-excellence-award/' . $status->courses->course_code . '/update-status/' . $status->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="custom-select my-1 mr-sm-2 status" name="status" required>
                            <option value="0" {{ $status->status == '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ $status->status == '1' ? 'selected' : '' }}>Approve</option>
                            <option value="2" {{ $status->status == '2' ? 'selected' : '' }}>Reject</option>
                        </select>
                    </div>
                    <div class="mb-3 hidden" id="reason">
                        <label for="">Reason</label>
                        <textarea class="form-control" name="reason" rows="2">{{ $status->reason }}</textarea>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            $('.status').on('change', checkPattern);
            // call to adjust div
            checkPattern();
        });
    </script>
@endsection
