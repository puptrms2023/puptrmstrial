@extends('layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800"> Graduating Student Assistant Applicant
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">
                        Student Information
                        <a href="{{ url('admin/non-academic-award/graduating-sa') }}"
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
                                <th width="25%">Organization</th>
                                <td><span class="badge badge-primary">{{ $form->orgs->name }}</span></td>
                            </tr>
                            <tr>
                                <th width="25%">Designated Office</th>
                                <td><span class="badge badge-primary">{{ $form->designated_office }}</span></td>
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
