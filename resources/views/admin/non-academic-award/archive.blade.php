@extends('layouts.admin')

@section('title', 'Overall')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Archives Non Academic Award - {{ $nonacad->name }}</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Students
                        <a href="{{ url('admin/non-academic-award/' . $nonacad->id) }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if (count($form) > 0)
                            <div class="mb-3">
                                <a href="{{ route('nonacad.restore_all', $nonacad->id) }}"
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
                                    <th>S.Y.</th>
                                    <th>Award Applied</th>
                                    <th class="text-center">Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form as $data)
                                    <tr>
                                        <td>{{ $data->users->stud_num }}</td>
                                        <td>
                                            {{ $data->users->first_name }} </td>
                                        <td>{{ $data->users->last_name }}</td>
                                        <td>{{ $data->courses->course_code }}</td>
                                        <td>{{ $data->school_year }}</td>
                                        <td>
                                            @if ($data->nonacad_id == '1')
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $data->orgs->name }}
                                                        @if (!empty($data->others))
                                                            - {{ $data->others }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @elseif ($data->nonacad_id == '2')
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Sport: {{ $data->sports }}</p>
                                                </div>
                                            @elseif ($data->nonacad_id == '3')
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $data->orgs->name }}
                                                        @if (!empty($data->others))
                                                            - {{ $data->others }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @elseif ($data->nonacad_id == '4')
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Subject Name: {{ $data->subject_name }}<br>
                                                        Thesis Title: {{ $data->thesis_title }}</p>
                                                </div>
                                            @elseif ($data->nonacad_id == '5')
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $data->orgs->name }}
                                                        @if (!empty($data->others))
                                                            - {{ $data->others }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @elseif ($data->nonacad_id == '6')
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Designation Office: {{ $data->designated_office }}<br>
                                                        School Organization: {{ $data->orgs->name }}
                                                        @if (!empty($data->others))
                                                            - {{ $data->others }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @elseif ($data->nonacad_id == '7')
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Competition Name: {{ $data->competition_name }}<br>
                                                        Placements: {{ $data->placement }}<br>
                                                        School Organization: {{ $data->orgs->name }}
                                                        @if (!empty($data->others))
                                                            - {{ $data->others }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @else
                                                <span class="badge badge-primary">{{ $data->nonacad->name }}</span>
                                            @endif
                                        </td>
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
                                            <a href="{{ route('nonacad.restore', $data->id) }}"
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
