@extends('layouts.user')

@section('title', 'Academic Excellence Status')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Non-Academic Award Status</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Status
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Award Applied</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($status as $item)
                                    <tr>
                                        <td class="font-weight-bold">{{ $item->users->stud_num }}</td>
                                        <td>{{ $item->users->first_name }}</td>
                                        <td>{{ $item->users->last_name }}</td>
                                        <td>{{ $item->courses->course_code }}</td>
                                        <td>{{ $item->year_level }}</td>
                                        <td> <span class="badge badge-success"> {{ $item->nonacad->name }}</span>
                                        </td>
                                        <td>
                                            <img src="{{ asset('uploads/' . $item->image) }}"
                                                class="img-thumbnail img-circle" width="50" alt="Image">
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
