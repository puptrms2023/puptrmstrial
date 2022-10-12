@extends('layouts.admin')

@section('title', 'View Parse Data')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Awardees
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-responsive table-sm" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Lname</th>
                                    <th>Fname</th>
                                    <th>Mname</th>
                                    <th>Course</th>
                                    <th>Yr Level</th>
                                    <th>Contact</th>
                                    <th>GWA 1st</th>
                                    <th>GWA 2nd</th>
                                    <th>Remarks</th>
                                    <th width="2%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $list)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $list->email_address }}</td>
                                        <td>{{ $list->surname }}</td>
                                        <td>{{ $list->first_name }}</td>
                                        <td>{{ $list->middle_name }}</td>
                                        <td>{{ $list->course }}</td>
                                        <td>{{ $list->year_level }}</td>
                                        <td>{{ $list->contact_number }}</td>
                                        <td>{{ $list->gwa_1st }}</td>
                                        <td>{{ $list->gwa_2nd }}</td>
                                        <td>{{ $list->remarks }}</td>
                                        <td>
                                            @can('csv delete')
                                                <button type="button" class="btn btn-sm btn-danger deleteCSVbtn"
                                                    value=""><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
