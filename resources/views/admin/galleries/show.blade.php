@extends('layouts.admin')

@section('title', 'Create User')

@section('content')
    <div class="modal" tabindex="-1" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Gallery</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('admin/galleries/delete') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p>Are you sure you want to delete the gallery?</p>
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

    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header font-weight-bold text-primary">Photos
                    <a href="{{ url('admin/galleries') }}" class="btn btn-primary btn-sm float-right">Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>{{ $gallery->description }}</p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($photos as $photo)
                            <div class="col-md-4 mb-4">
                                <div class="img-hover-zoom img-hover-zoom--xyz shadow-sm">
                                    <a href="{{ url('admin/galleries/photos/show/' . $photo->id) }}">
                                        <img src="{{ asset('uploads/galleries/photos/' . $photo->photo) }}" class=""
                                            width="100%" alt="photo"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header font-weight-bold text-primary">{{ $gallery->title }}
                </div>
                <div class="card-body text-center">
                    <img src="{{ asset('uploads/galleries/' . $gallery->cover) }}" class="mb-2" width="100%"
                        alt="cover">
                    @can('gallery edit')
                        <a href="{{ url('admin/galleries/edit/' . $gallery->id) }}"
                            class="btn btn-sm btn-block btn-secondary">Edit Gallery</a>
                    @endcan
                    @can('photo create')
                        <a href="{{ url('admin/galleries/photos/create/' . $gallery->id) }}"
                            class="btn btn-sm btn-block btn-success mb-2">Upload
                            Photo</a>
                    @endcan
                    @can('gallery delete')
                        <button type="button" class="btn btn-sm btn-block btn-danger deletePhotobtn"
                            value="{{ $gallery->id }}">Delete Gallery</button>
                    @endcan
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
