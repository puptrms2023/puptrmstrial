@extends('layouts.admin')

@section('title', $courses->course)

@section('content')
    <div class="d-sm-flex align-awardees-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">{{ $courses->course }} - Achiever's Awardees</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div id="send-button" class="col-md-12 mb-2">
            <button class="btn btn-success send-email"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Send
                E-Certificates</button>
        </div>
        <div id="spinner-div" class="col-md-12 mb-2 hidden">
            <button class="btn btn-success" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Send E-Certificates
            </button>
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
                    </div>
                </div>
                <input type="hidden" value="{{ $courses->course_code }}" id="course_id">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-cert" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Course</th>
                                    <th>Year Level</th>
                                    <th>GWA</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($awardees as $awardee)
                                    <tr>
                                        <td><input type="checkbox" class="user-checkbox" name="users[]"
                                                value="{{ $awardee->id }}"></td>
                                        <td>{{ $awardee->users->last_name }}</td>
                                        <td>{{ $awardee->users->first_name }}</td>
                                        <td>{{ $awardee->courses->course_code }}</td>
                                        <td>{{ $awardee->year_level }}</td>
                                        <td>{{ $awardee->gwa }}</td>
                                        <td>
                                            @if ($awardee->certificate_status == '1')
                                                <span class="text-success">Sent</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/send-awardees-certificates/' . $awardee->courses->course_code . '/' . $awardee->id) }}"
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
        $(".send-email").click(function() {
            var course_id = document.getElementById("course_id").value;
            var selectRowsCount = $("input[class='user-checkbox']:checked").length;
            if (selectRowsCount > 0) {

                var ids = $.map($("input[class='user-checkbox']:checked"), function(c) {
                    return c.value;
                });

                $('#send-button').addClass('hidden');
                $('#spinner-div').removeClass('hidden');

                $.ajax({
                    type: 'POST',
                    url: "/admin/send-awardees-certificates/" +
                        course_id +
                        "/send",
                    data: {
                        ids: ids
                    },
                    success: function(data) {
                        toastr.success(data.success);
                        $('#send-button').removeClass('hidden');
                        $('#spinner-div').addClass('hidden');
                    },
                });

            } else {
                alert("Please select at least one user from list.");
            }
            console.log(selectRowsCount);
        });
    </script>
@endsection
