@extends('layouts.admin')

@section('title', 'View Students')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="text-primary font-weight-bold">
                        STUDENT INFORMATION
                        <a href="{{ url('admin/students') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-2">
                            <div class="col">
                                <label class="small text-muted">STUDENT NUMBER:</label>
                                <input type="text" class="form-control text-uppercase font-weight-bold"
                                    value="{{ $students->stud_num }}" disabled>
                            </div>
                            <div class="col">
                                <label class="small text-muted">USERNAME:</label>
                                <input type="text" class="form-control text-uppercase font-weight-bold"
                                    value="{{ $students->username }}" disabled>
                            </div>
                            <div class="col">
                                <label class="small text-muted">FIRST NAME:</label>
                                <input class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->first_name }}" disabled />
                            </div>
                            <div class="col">
                                <label class="small text-muted">MIDDLE NAME:</label>
                                <input class="form-control font-weight-bold text-uppercase" value="" disabled />
                            </div>
                            <div class="col">
                                <label class="small text-muted">LAST NAME:</label>
                                <input class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->last_name }}" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label class="small text-muted">COURSE:</label>
                                <input class="form-control font-weight-bold text-uppercase"
                                    value="{{ $students->courses->course }}" disabled />
                            </div>
                            <div class="col-2">
                                <label class="small text-muted">PHONE</label>
                                <input class="form-control font-weight-bold text-uppercase" value="{{ $students->contact }}"
                                    disabled />
                            </div>
                            <div class="col-4">
                                <label class="small text-muted">EMAIL:</label>
                                <input class="form-control font-weight-bold text-uppercase" value="{{ $students->email }}"
                                    disabled />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-sm table-bordered">
                        <thead class="text-primary">
                            <tr>
                                <th>Award Applied</th>
                                <th>Yesr Level</th>
                                <th>1st Sem GWA</th>
                                <th>2nd Sem GWA</th>
                                <th>Average</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($application as $app)
                                <tr>
                                    <td>
                                        @if ($app->award_applied == '1')
                                            <span class="badge badge-danger">ACHIEVER'S AWARD</span>
                                        @endif
                                        @if ($app->award_applied == '2')
                                            <span class="badge badge-info">DEAN'S LIST</span>
                                        @endif
                                        @if ($app->award_applied == '3')
                                            <span class="badge badge-success">PRESIDENT'S LIST</span>
                                        @endif
                                    </td>
                                    <td>{{ $app->year_level }}</td>
                                    <td>{{ $app->gwa_1st }}</td>
                                    <td>{{ $app->gwa_2nd }}</td>
                                    <td>{{ $app->gwa }}</td>
                                    <td>
                                        @if ($app->status == '0')
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                        @if ($app->status == '1')
                                            <span class="badge badge-success">Approved</span>
                                        @endif
                                        @if ($app->status == '3')
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ $app->created_at }}</td>
                                </tr>
                            @empty
                                <p class="small text-danger">No Application Form Submitted</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
