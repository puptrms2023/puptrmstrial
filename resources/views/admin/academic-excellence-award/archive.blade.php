@extends('layouts.admin')

@section('title', 'Overall')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Archives Academic Excellence Award - {{ $course->course_code }}</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Students
                        <a href="{{ url('admin/academic-excellence-award/' . $course->course_code) }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($form) > 0)
                            <div class="mb-3">
                                <a href="{{ route('excellence.restore_all', $course->course_code) }}"
                                    class="btn btn-sm btn-info">Restore All</a>
                            </div>
                        @endif
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>S.Y.</th>
                                    <th>Average</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form as $data)
                                    @php
                                        $totalwithSummer = ($data->gwa1 + $data->gwa2 + $data->gwa3 + $data->gwa4 + $data->gwa5 + $data->gwa6 + $data->gwa7 + $data->gwa8 + $data->gwa9) / 9;
                                        $totalwith5thYear = ($data->gwa1 + $data->gwa2 + $data->gwa3 + $data->gwa4 + $data->gwa5 + $data->gwa6 + $data->gwa7 + $data->gwa8 + $data->gwa10 + $data->gwa11) / 10;
                                        $totalwith5thAndSummer = ($data->gwa1 + $data->gwa2 + $data->gwa3 + $data->gwa4 + $data->gwa5 + $data->gwa6 + $data->gwa7 + $data->gwa8 + $data->gwa9 + $data->gwa10 + $data->gwa11) / 11;
                                    @endphp
                                    <tr>
                                        <td>{{ $data->users->stud_num }}</td>
                                        <td>
                                            {{ $data->users->first_name }} </td>
                                        <td>{{ $data->users->last_name }}</td>
                                        <td>{{ $data->courses->course_code }}</td>
                                        <td>{{ $data->year_level }}</td>
                                        <td>{{ $data->school_year }}</td>
                                        <td>
                                            @if (!empty($data->gwa9) && empty($data->gwa10))
                                                {{ round($totalwithSummer, 2) }}
                                            @elseif (!empty($data->gwa10 || $data->gwa11) && empty($data->gwa9))
                                                {{ round($totalwith5thYear, 2) }}
                                            @elseif (!empty($data->gwa9 && $data->gwa10))
                                                {{ round($totalwith5thAndSummer, 2) }}
                                            @else
                                                {{ $data->gwa }}
                                            @endif
                                        </td>
                                        <td><img src="{{ asset('uploads/' . $data->image) }}" alt="img"
                                                class="img-thumbnail img-circle" width="50"></td>
                                        <td>
                                            @if ($data->status == '0')
                                                Pending
                                            @elseif($data->status == '1')
                                                Approved
                                            @else
                                                Rejected
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('excellence.restore', $data->id) }}"
                                                class="btn btn-sm btn-success">Restore</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
