@extends('layouts.admin')

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
                                <th width="25%">Award Applied</th>
                                <td>
                                    @if ($form->nonacad_id == '1')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>School Organization: {{ $form->orgs->name }}</p>
                                        </div>
                                    @elseif ($form->nonacad_id == '2')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Sport: {{ $form->sports }}</p>
                                        </div>
                                    @elseif ($form->nonacad_id == '3')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Sport: {{ $form->sports }}<br>
                                                School Organization: {{ $form->orgs->name }}</p>
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
                                            <P>School Organization: {{ $form->orgs->name }}</p>
                                        </div>
                                    @elseif ($form->nonacad_id == '6')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Designation Office: {{ $form->designated_office }}<br>
                                                School Organization: {{ $form->orgs->name }}</p>
                                        </div>
                                    @elseif ($form->nonacad_id == '7')
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                        <div class="small">
                                            <P>Competition Name: {{ $form->competition_name }}<br>
                                                Placements: {{ $form->placement }}<br>
                                                School Organization: {{ $form->orgs->name }}</p>
                                        </div>
                                    @else
                                        <span class="badge badge-primary">{{ $form->nonacad->name }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th width="25%">Remarks</th>
                                <td>{{ $form->remarks }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="float-right"> Added at {{ $form->created_at }} </small>
                </div>
            </div>
        </div>
    </div>
@endsection
