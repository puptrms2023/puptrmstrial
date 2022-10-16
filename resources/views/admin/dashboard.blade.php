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
    <div class="row">

        <!-- Total Achiever's Award Applicants -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Achiever's Award Applicants</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $analytics_achiever }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-medal fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Dean's List Applicants -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Dean's List Applicants</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $analytics_deans }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-medal fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total President's List Applicants -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total President's List
                                Applicants
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $analytics_presidents }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-medal fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Academic Excellence -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Academic Excellence</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $analytics_acadexcell }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa-solid fa-medal fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row mt-4 mb-4">
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>

@endsection

@section('scripts')

    <script>
        var academic_year = '{{ $year }}';
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
                text: 'Awardees in Academic Year ' + academic_year
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
                allowDecimals: false,
                min: 0,
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
