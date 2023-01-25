@extends('layouts.admin')

@section('title', 'Show Non Academic Applicants')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800"> {{ $form->nonacad->name }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">
                        Student Information
                        <a href="{{ url('admin/non-academic-award/' . $form->nonacad->id) }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <tr>
                                <th width="25%">Student Number</th>
                                <td>{{ $form->users->stud_num }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Student Name</th>
                                <td>{{ $form->users->first_name . ' ' . $form->users->last_name }}</td>
                            </tr>
                            <tr>
                                <th>Course</th>
                                <td>{{ $form->courses->course }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Year Level</th>
                                <td>{{ $form->year_level }}</td>
                            </tr>
                            <tr>
                                <th width="25%">School Year</th>
                                <td><b>{{ $form->school_year }}</b></td>
                            </tr>
                            <tr>
                                <th width="25%">Award Applied</th>
                                <td>
                                    @if ($form->nonacad_id == '1')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>School Organization: {{ $form->orgs->name }}
                                                @if (!empty($form->others))
                                                    - {{ $form->others }}
                                                @endif
                                            </p>
                                        </div>
                                    @elseif ($form->nonacad_id == '2')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Sport: {{ $form->sports }}</p>
                                        </div>
                                    @elseif ($form->nonacad_id == '3')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>School Organization: {{ $form->orgs->name }}
                                                @if (!empty($form->others))
                                                    - {{ $form->others }}
                                                @endif
                                            </p>
                                        </div>
                                    @elseif ($form->nonacad_id == '4')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Subject Name: {{ $form->subject_name }}<br>
                                                Thesis Title: {{ $form->thesis_title }}</p>
                                        </div>
                                    @elseif ($form->nonacad_id == '5')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>School Organization: {{ $form->orgs->name }}
                                                @if (!empty($form->others))
                                                    - {{ $form->others }}
                                                @endif
                                            </p>
                                        </div>
                                    @elseif ($form->nonacad_id == '6')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Designation Office: {{ $form->designated_office }}<br>
                                                School Organization: {{ $form->orgs->name }}
                                                @if (!empty($form->others))
                                                    - {{ $form->others }}
                                                @endif
                                            </p>
                                        </div>
                                    @elseif ($form->nonacad_id == '7')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Competition Name: {{ $form->competition_name }}<br>
                                                Placements: {{ $form->placement }}<br>
                                                School Organization: {{ $form->orgs->name }}
                                                @if (!empty($form->others))
                                                    - {{ $form->others }}
                                                @endif
                                            </p>
                                        </div>
                                    @else
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th width="25%">Supporting Documents</th>
                                <td>
                                    <a href="{{ asset($form->file_path) }}" class="btn-link text-muted"
                                        target="_blank">{{ $form->file_name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <th width="25%">2x2 photo</th>
                                <td>
                                    <img src="{{ asset('uploads/' . $form->image) }}" alt="" width="150px"
                                        height="150px">
                                </td>
                            </tr>
                            <tr>
                                <th width="25%">Remarks</th>
                                <td>{{ $form->remarks }}</td>
                            </tr>
                            <tr>
                                <th width="25%">Status</th>
                                <td>
                                    @if ($form->status == '0')
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                    @if ($form->status == '1')
                                        <span class="badge badge-success">Approved</span>
                                    @endif
                                    @if ($form->status == '2')
                                        <span class="badge badge-danger">Rejected</span>
                                        @if ($form->reason != '')
                                            <small> -
                                                @if ($form->reason == '1')
                                                    Others: {{ $form->others }}
                                                @else
                                                    {{ $form->reasons->description }}
                                                @endif
                                            </small>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="float-right"> Added at {{ $form->created_at }} </small>
                </div>
            </div>
        </div>
    </div>
    @can('non-academic award edit')
        <div class="row">
            <div class="col-md-6">
                <form action="{{ url('admin/non-academic-award/' . $form->nonacad_id . '/update-status/' . $form->id) }}"
                    method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="">Status</label>
                        <select class="custom-select my-1 mr-sm-2 status" name="status" required>
                            <option value="0" {{ $form->status == '0' ? 'selected' : '' }}>Pending</option>
                            <option value="1" {{ $form->status == '1' ? 'selected' : '' }}>Approve</option>
                            <option value="2" {{ $form->status == '2' ? 'selected' : '' }}>Reject</option>
                        </select>
                    </div>
                    <div class="mb-3 hidden" id="reject">
                        <label for="">Reason</label>
                        <select name="reason" id="" class="custom-select reject">
                            @foreach ($reasons->skip(1) as $id => $item)
                                <option value="{{ $id }}" {{ $form->reason == $id ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                            @foreach ($reasons->take(1) as $id => $item)
                                <option value="{{ $id }}" {{ $form->reason == $id ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 hidden" id="others">
                        <textarea class="form-control" name="others" rows="2">{{ $form->others }}</textarea>
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-secondary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endcan
@endsection
