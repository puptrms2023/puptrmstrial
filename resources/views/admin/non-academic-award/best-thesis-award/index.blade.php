@extends('layouts.admin')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Application Form</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/non-academic-award/best-thesis-award/delete-form') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the submitted application form?</p>
                        <input type="hidden" name="form_delete_id" id="form_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Best Thesis Award</div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="m-0 font-weight-bold text-primary">
                        Students
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-primary">
                            <tr>
                                <th>Student No.</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Course</th>
                                <th>Year Lvel</th>
                                <th>Subject Name</th>
                                <th>Thesis/Capstone Title</th>
                                <th>Photo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($form as $award)
                                <tr>
                                    <td>{{ $award->users->stud_num }}</td>
                                    <td>{{ $award->users->first_name }}</td>
                                    <td>{{ $award->users->last_name }}</td>
                                    <td>{{ $award->courses->course_code }}</td>
                                    <td>{{ $award->year_level }}</td>
                                    <td>{{ $award->subject_name }}</td>
                                    <td>{{ $award->thesis_title }}</td>
                                    <td>
                                        <img src="{{ asset('uploads/' . $award->image) }}" class="img-thumbnail img-circle"
                                            width="50" alt="Image">
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/non-academic-award/best-thesis-award/' . $award->id) }}"
                                            class="btn btn-secondary btn-sm"><i class="fa-regular fa-eye"></i></a>

                                        <button type="button" class="btn btn-sm btn-danger deleteFormbtn"
                                            value="{{ $award->id }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.deleteFormbtn').click(function(e) {
                e.preventDefault();

                var user_id = $(this).val();
                $('#form_id').val(user_id)
                $('#deleteModal').modal('show');

            });
        });
    </script>
@endsection
