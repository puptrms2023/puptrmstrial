@extends('layouts.admin')

@section('title', $courses->course_code . ' - Course List')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">{{ $courses->course_code }} - Course List</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-2">
                <a href="{{ url('admin/maintenance/course-list') }}" class="btn btn-primary btn-sm ml-auto">Back</a>
            </div>

            <form action="{{ url('admin/maintenance/course-list', $courses->id) }}" method="POST">
                @csrf

                @include('admin.maintenance.program-subjects.firstyear')
                @include('admin.maintenance.program-subjects.secondyear')
                @include('admin.maintenance.program-subjects.thirdyear')
                @include('admin.maintenance.program-subjects.fourthyear')

                @if ($courses->course_code == 'BSME')
                    @include('admin.maintenance.program-subjects.fifthyear')
                @endif

                <div class="mb-4">
                    <button type="submit" class="btn btn-secondary">Update</button>
                </div>
            </form>
        </div>
    </div>

    @include('admin.maintenance.program-subjects.modal')

@endsection

@section('scripts')
    <script>
        var sub = {!! json_encode($sub) !!};
        $('.deleteSub').click(function(e) {
            e.preventDefault();

            var sub_id = $(this).val();
            $('#sub_id').val(sub_id)
            $('#deleteModal').modal('show');

        });
    </script>
    <script src="{{ asset('admin/js/subject.js') }}"></script>
@endsection
