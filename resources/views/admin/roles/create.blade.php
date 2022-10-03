@extends('layouts.admin')

@section('title', 'Create Role')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">Add Roles
                        <a href="{{ url('admin/roles') }}" class="btn btn-primary btn-sm float-right">Back</a>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.messages')

                    <form method="POST" action="{{ url('admin/roles') }}">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="small mb-1">Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter name"
                                    value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="d-inline mb-2">
                                <strong>Permissions: </strong>
                                <label><input type="checkbox" id="select-all" /> Check
                                    all</label>
                            </div>
                            @foreach ($permission as $value)
                                <div class="col-md-3 mt-2">
                                    <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                        {{ $value->name }}</label>
                                    <br />
                                </div>
                            @endforeach
                        </div>
                        <button class="btn btn-primary" type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var selectAllItems = "#select-all";
            var checkboxItem = ":checkbox";

            $(selectAllItems).click(function() {

                if (this.checked) {
                    $(checkboxItem).each(function() {
                        this.checked = true;
                    });
                } else {
                    $(checkboxItem).each(function() {
                        this.checked = false;
                    });
                }

            });
        });
    </script>
@endsection
