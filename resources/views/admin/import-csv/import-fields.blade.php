@extends('layouts.admin')

@section('title', 'Parse CSV')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            @include('layouts.partials.messages')

            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ url('admin/import-csv/import-process') }}" method="POST">
                        @csrf

                        <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />

                        <table class="table table-bordered table-responsive table-sm" id="dataTable" width="100%"
                            cellspacing="0">
                            @if (isset($headings))
                                <thead>
                                    <tr>
                                        @foreach ($headings[0][0] as $csv_header_field)
                                            {{-- @dd($headings) --}}
                                            <th class="bg-light">
                                                <span
                                                    class="text-left text-xs text-primary text-uppercase">{{ $csv_header_field }}</span>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                            @endif

                            <tbody class="bg-white">
                                @foreach ($csv_data as $row)
                                    <tr class="bg-white">
                                        @foreach ($row as $key => $value)
                                            <td class="text-xs text-uppercase">
                                                {{ $value }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach

                                <tr>
                                    @foreach ($csv_data[0] as $key => $value)
                                        <td class="text-sm">
                                            <select name="fields[{{ $key }}]"
                                                class="form-control form-control-sm font-weight-bold text-primary">
                                                @foreach (config('app.db_fields') as $db_field)
                                                    <option value="{{ \Request::has('header') ? $db_field : $loop->index }}"
                                                        @if ($key === $db_field) selected @endif>
                                                        {{ $db_field }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>

                        <button class="btn btn-secondary btn-sm mt-4">
                            Import Data
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
