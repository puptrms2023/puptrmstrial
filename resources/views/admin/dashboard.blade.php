@extends('layouts.admin')

@section('title', 'PUPT RMS Dashboard')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ Auth::user()->first_name }}'s Dashboard</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <a class="card lift h-100" href="{{ url('admin/achievers-award') }}">
                <div class="card-body border-left-danger d-flex justify-content-center flex-column">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-danger text-uppercase mb-1 ">
                                Achiever's Award Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">First year students</div>
                        </div>
                        <div class="col-12">
                            <i class="fas fa-solid fa-award fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a class="card lift h-100" href="{{ url('admin/deans-list-award') }}">
                <div class="card-body border-left-info d-flex justify-content-center flex-column">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-info text-uppercase mb-1 ">
                                Dean's List Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Second to Fourth year students</div>
                        </div>
                        <div class="col-12">
                            <i class="fas fa-solid fa-award fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <a class="card lift h-100" href="{{ url('admin/presidents-list-award') }}">
                <div class="card-body border-left-success d-flex justify-content-center flex-column">
                    <div class="row no-gutters align-items-center text-center">
                        <div class="col mr-2">
                            <div class="text-md font-weight-bold text-success text-uppercase mb-1 ">
                                President's List Applications</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Second to Fourth year students</div>
                        </div>
                        <div class="col-12">
                            <i class="fas fa-solid fa-award fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row mt-4 mb-4">
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>

@endsection

@section('scripts')

    <script>
        var achiever = @json($achiever);
        const output_achiever = achiever.map(({
            course_code,
            total
        }) => [course_code, total]);

        var dean = @json($deans);
        const output_dean = dean.map(({
            course_code,
            total
        }) => [course_code, total]);

        var president = @json($president);
        const output_president = president.map(({
            course_code,
            total
        }) => [course_code, total]);

        var acad_excellence = @json($excellence);
        const output_acad_excellence = acad_excellence.map(({
            course_code,
            total
        }) => [course_code, total]);

        var total_achiever = {{ json_encode($total_achiever) }}
        var total_deans_lister = {{ json_encode($total_dean) }}
        var total_presidents_lister = {{ json_encode($total_president) }}
        var total_acad_excellence = {{ json_encode($total_excellence) }}

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: 'Awardees in School Year 2022-2023'
            },
            subtitle: {
                align: 'left'
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total number of awardees'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
            },

            series: [{
                name: "Academic Award",
                colors: ['#ff7675', '#81ecec', '#fed330', '#00b894', '#24CBE5', '#64E572', '#FF9655',
                    '#FFF263', '#6AF9C4'
                ],
                colorByPoint: true,
                data: [{
                        name: "Achiever's Award",
                        y: total_achiever,
                        drilldown: "Achiever"
                    },
                    {
                        name: "Dean's Lister",
                        y: total_deans_lister,
                        drilldown: "Dean"
                    },
                    {
                        name: "President's Lister",
                        y: total_presidents_lister,
                        drilldown: "President"
                    },
                    {
                        name: "Academic Excellence",
                        y: total_acad_excellence,
                        drilldown: "Excellence"
                    }
                ]
            }],
            drilldown: {
                breadcrumbs: {
                    position: {
                        align: 'right'
                    }
                },
                series: [{
                        name: "Achiever's Award",
                        id: "Achiever",
                        data: output_achiever
                    },
                    {
                        name: "Dean's Lister",
                        id: "Dean",
                        data: output_dean
                    },
                    {
                        name: "President's Lister",
                        id: "President",
                        data: output_president
                    },
                    {
                        name: "Academic Excellence",
                        id: "Excellence",
                        data: output_acad_excellence
                    },
                ]
            }
        });
    </script>
@endsection
