@extends('layouts.admin')

@section('title', 'Show Photo')

@section('content')

    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Photo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/galleries/photos/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the photo?</p>
                        <input type="hidden" name="image_delete_id" id="image_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row justify-contify-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bold text-primary">
                    Actions
                </div>
                <div class="card-body">
                    @can('photo edit')
                        <a href="{{ url('admin/galleries/photos/edit/' . $photo->id) }}"
                            class="btn btn-sm btn-secondary btn-block">Edit Photo</a>
                    @endcan
                    @can('photo delete')
                        <button type="button" class="btn btn-sm btn-block btn-danger deletePhotobtn"
                            value="{{ $photo->id }}">Delete Photo</button>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header font-weight-bold text-primary">
                    {{ $photo->title }}
                    <a href="{{ url('admin/galleries/show/' . $photo->gallery_id) }}"
                        class="btn btn-primary btn-sm float-right">Back</a>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            {{ $photo->description }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{ asset('uploads/galleries/photos/' . $photo->photo) }}" alt="photo"
                                class="" width="100%">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $('.deletePhotobtn').click(function(e) {
                e.preventDefault();

                var image_id = $(this).val();
                console.log(image_id);
                $('#image_id').val(image_id)
                $('#deleteModal').modal('show');

            });
        });
    </script>

@endsection
