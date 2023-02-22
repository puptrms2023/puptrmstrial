@extends('layouts.user')

@section('title', 'My Awards')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="h3 mb-0 text-gray-800">Awards</div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="m-0 font-weight-bold text-primary">My Awards
                    </div>
                </div>
                <div class="card-body">
                    @if (count($awards) <= 0)
                        No Awards
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                </thead>
                                <tbody>
                                    @foreach ($awards as $data)
                                        <tr>
                                            <td>
                                                <div class="media">
                                                    {!! awardIcon($data->award_acronym) !!}
                                                    <div class="media-body ml-2">
                                                        <h6 class="mt-0 text-dark">{{ $data->award_name }}</h6>
                                                        <small>{{ $data->school_year }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
