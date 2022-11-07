@extends('layouts.admin')

@section('title', 'Non Academic Award')

@section('content')
    <div class="d-sm-flex align-awardees-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">{{ $nonacad->name }} - Non Academic Applicants</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div id="send-button" class="col-md-12 mb-2">
            <button class="btn btn-success send-email-na"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Send
                Certificates</button>
            <div class="float-right text-muted text-gray-600">Total Email sent:
                {{ $count }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Students
                        <a href="{{ url('admin/send-awardees-certificates/non-academic-award') }}"
                            class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-primary">
                                <tr>
                                    <th class="text-center"><input type="checkbox" name="checkAll" class="checkAll">
                                    </th>
                                    <th>Student No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>Award Applied</th>
                                    <th>Photo</th>
                                    <th class="text-center">Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($form as $award)
                                    <tr>
                                        <td><input type="checkbox" class="email-checkboxes" name="users[]"
                                                value="{{ $award->id }}">
                                        </td>
                                        <td>{{ $award->users->stud_num }}</td>
                                        <td>{{ $award->users->first_name }}</td>
                                        <td>{{ $award->users->last_name }}</td>
                                        <td>{{ $award->courses->course_code }}</td>
                                        <td>{{ $award->year_level }}</td>
                                        <td>
                                            @if ($award->nonacad_id == '1')
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $award->orgs->name }}</p>
                                                </div>
                                            @elseif ($award->nonacad_id == '2')
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Sport: {{ $award->sports }}</p>
                                                </div>
                                            @elseif ($award->nonacad_id == '3')
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $award->orgs->name }}</p>
                                                </div>
                                            @elseif ($award->nonacad_id == '4')
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Subject Name: {{ $award->subject_name }}<br>
                                                        Thesis Title: {{ $award->thesis_title }}</p>
                                                </div>
                                            @elseif ($award->nonacad_id == '5')
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>School Organization: {{ $award->orgs->name }}</p>
                                                </div>
                                            @elseif ($award->nonacad_id == '6')
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Designation Office: {{ $award->designated_office }}<br>
                                                        School Organization: {{ $award->orgs->name }}</p>
                                                </div>
                                            @elseif ($award->nonacad_id == '7')
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                                <div class="small">
                                                    <P>Competition Name: {{ $award->competition_name }}<br>
                                                        Placements: {{ $award->placement }}<br>
                                                        School Organization: {{ $award->orgs->name }}</p>
                                                </div>
                                            @else
                                                <span class="badge badge-primary">{{ $award->nonacad->name }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <img src="{{ asset('uploads/' . $award->image) }}"
                                                class="img-thumbnail img-circle" width="50" alt="Image">
                                        </td>
                                        <td class="text-center">
                                            @if ($award->certificate_status == '1')
                                                <span class="badge badge-success">Sent</span>
                                            @else
                                                <span class="badge badge-warning">Waiting</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/send-awardees-certificates/non-academic-award/' . $award->nonacad_id . '/' . $award->id) }}"
                                                target="_blank" class="btn btn-sm btn-secondary">Preview</a>
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

@section('scripts')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".send-email-na").click(function() {
            var selectRowsCount = $("input[class='email-checkboxes']:checked").length;
            if (selectRowsCount > 0) {

                var ids = $.map($("input[class='email-checkboxes']:checked"), function(c) {
                    return c.value;
                });
                $(this).attr("disabled", true);
                $(this).html('<i class="fa fa-spinner fa-spin"></i> Send Certificates');
                console.log(ids);
                $.ajax({
                    type: 'POST',
                    url: "{{ url('admin/send-awardees-certificates/non-academic-award/' . $nonacad->id . '/send') }}",
                    data: {
                        ids: ids
                    },
                    success: function(data) {
                        toastr.success(data.success);
                        $('.send-email-na').attr("disabled", false);
                        $('.send-email-na').html(
                            '<i class="fas fa-paper-plane"></i> Send Certificates');
                        setInterval('refreshPage()', 1000);
                    }
                });

            } else {
                alert("Please select at least one user from list.");
            }
            console.log(selectRowsCount);
        });
    </script>
@endsection
