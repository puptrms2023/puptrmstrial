@extends('layouts.admin')

@section('title', 'Form Maintenance')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="text-primary font-weight-bold m-0">Award<a href="{{ url('admin/maintenance/form') }}"
                            class="btn btn-primary btn-sm float-right">Back</a></div>
                </div>
                <div class="card-body">

                    @include('layouts.partials.messages')

                    <form action="{{ url('admin/maintenance/update-form/' . $form->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label class="text-gray font-weight-bold">Award Category </label>
                                <input type="text" class="form-control" value="{{ $form->award_form }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5 mb-2">
                                <label class="text-gray font-weight-bold">Photo Card <span
                                        class="text-danger">*</span></label>
                                <div class="mb-2"><img src="{{ asset('uploads/form/' . $form->photocard) }}"
                                        class="img-thumbnail" alt="image">
                                </div>
                                <input type="file" class="form-control" name="photocard">
                                <input type="hidden" value="{{ $form->photocard }}" name="old_photo">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="p-0">
                                    <table class="table table-borderless" id="dynamicAddRemove">
                                        <tr>
                                            <th>Requirements</th>
                                            <th width="10"><button type="button" name="add" id="dynamic-ar"
                                                    class="btn btn-success">Add
                                                </button></td>
                                            </th>
                                        </tr>
                                        @foreach ($form->requirements as $reqs)
                                            <tr>
                                                <td><input type="text" name="addMoreInputFields[0][requirement]"
                                                        placeholder="Enter requirements"
                                                        value="{{ $reqs['requirement'] }}"class="form-control" />
                                                </td>

                                                @if (!$loop->first)
                                                    <td><button type="button"
                                                            class="btn btn-secondary remove-input-field"><i
                                                                class="fa-solid fa-circle-minus"></i></button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function() {
            ++i;
            $("#dynamicAddRemove").append('<tr><td><input type="text" name="addMoreInputFields[' + i +
                '][requirement]" placeholder="Enter requirements" class="form-control" /></td><td><button type="button" class="btn btn-secondary remove-input-field"><i class="fa-solid fa-circle-minus"></i></button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function() {
            $(this).parents('tr').remove();
        });
    </script>

@endsection
