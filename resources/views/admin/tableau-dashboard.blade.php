@php
    use App\Http\Controllers\TableauController;
@endphp

@extends('admin.layouts.base')


@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.37.0/apexcharts.min.css"
        integrity="sha512-tJYqW5NWrT0JEkWYxrI4IK2jvT7PAiOwElIGTjALSyr8ZrilUQf+gjw2z6woWGSZqeXASyBXUr+WbtqiQgxUYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tableau de bord</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <link rel="stylesheet" href="{{ asset('css/chart.css') }}">

        <section class="section dashboard">

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="flex-container">

                <div class="flex-item">
                    <div class="chart-main-title">
                        Paiements</div>
                    <div class="flex-row">
                        <div class="item">
                            <canvas id="myChart" height="200px"></canvas>
                        </div>
                        <div class="item">
                            <canvas id="myChart1" height="200px"></canvas>
                        </div>
                        <div class="item">
                            <canvas id="myChart2" height="200px"></canvas>
                        </div>
                    </div>
                </div>


                <div class="flex-item">
                    <div class="chart-main-title">
                        Rendez vous</div>
                    <div class="flex-row">

                        <div class="item">
                            <canvas id="rdv-pie" height="200px"></canvas>
                        </div>
                        <div class="item">
                            <canvas id="types" height="200px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="flex-item">
                    <div class="chart-main-title">
                        LIVRAISON PASSEPORT/NIP</div>
                    <div class="flex-row">

                        <div class="item">
                            <canvas id="distribution" height="200px"></canvas>
                        </div>
                        <div class="item">
                            <canvas id="waiting-passeport" height="200px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="flex-item">
                    <div class="chart-main-title">
                        Situation par service</div>
                    <div class="flex-row">

                        <div class="item">
                            <canvas id="chart-group" height="200px"></canvas>
                        </div>
                        <div class="item">
                            <canvas id="chart-group1" height="200px"></canvas>
                        </div>
                    </div>
                </div>

            </div>


            {{-- <div style="display:flex; flex-direction:column;gap:3rem">

                <div class="full-width" style="display: flex; gap:1rem">
                    <span class="w-50" style="width:50% !important; background-color:brown; color:white; padding:1rem">
                        {!! $paymentChart->container() !!}
                        {!! $paymentChart->script() !!}</span>
                    <span class="w-50" style="width:50% !important; background-color:brown; color:white; padding:1rem">
                        {!! $paymentChart->container() !!}
                        {!! $paymentChart->script() !!}
                    </span>
                </div>
                <div class="chart-container" style="padding: 1rem; background-color:red">
                    {!! $paymentChart->container() !!}
                    {!! $paymentChart->script() !!}
                </div>

                <div class="chart-container" style="padding: 1rem; background-color:white">


                    {!! $operatorPieChart->container() !!}

                    {!! $operatorPieChart->script() !!}
                </div>
                <div class="chart-container" style="padding: 1rem; background-color:white">


                    {!! $productionPassport->container() !!}

                    {!! $productionPassport->script() !!}
                </div>
                <div class="flex" style="display:flex; flex-direction:row;">
                    <div style="padding: 1rem; background-color:white">


                        {!! $groupBarChart->container() !!}

                        {!! $groupBarChart->script() !!}
                    </div>

                </div>

            </div> --}}
        </section>

    </main><!-- End #main -->



    <script src="{{ asset('/js/app.js') }}"></script>
    <script type="text/javascript">
        var labels = {{ Js::from($labels) }};
        var rdvPieLabels = {{ Js::from($rdvPieLabels) }};
        var typeServiceLabels = {{ Js::from($typeServiceLabels) }};
        var mtnDataSource = {{ Js::from($mtnData) }};
        var orgDataSource = {{ Js::from($orgData) }};
        var bankDataSource = {{ Js::from($bankData) }};
        var rdvPieDataSource = {{ Js::from($rdvPieData) }};
        var typeDataSource = {{ Js::from($typeServiceData) }};
        var distributionPasseportDataSource = {{ Js::from($distributionPasseportData) }};
        //MTN DATA CHART 
        const mtnData = {
            labels: labels,
            datasets: [{
                label: 'MTN',
                borderColor: '#febf0f',
                backgroundColor: '#febf0f',
                data: mtnDataSource,
            }]
        };

        const mtnConfig = {
            type: 'line',
            data: mtnData,

            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            mtnConfig
        );

        //End of MTN data chart


        //Orange data
        const orgData = {
            labels: labels,
            datasets: [{
                label: 'Orange',
                borderColor: '#df8143',
                backgroundColor: '#df8143',
                data: mtnDataSource,
            }]
        };

        const orgConfig = {
            type: 'line',
            data: orgData,

            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };
        const myChart1 = new Chart(
            document.getElementById('myChart1'),
            orgConfig
        );
        //Bank data
        const bankData = {
            labels: labels,
            datasets: [{
                label: 'Banque',
                borderColor: '#456fb9',
                backgroundColor: '#456fb9',
                data: mtnDataSource,
            }]
        };

        const bankConfig = {
            type: 'line',
            data: bankData,

            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };
        const myChart2 = new Chart(
            document.getElementById('myChart2'),
            bankConfig
        );

        //Rdv Pie 

        const rdvPieData = {
            labels: rdvPieLabels,
            datasets: [{
                label: 'RDV par services',

                data: rdvPieDataSource,
            }]
        };

        const rdvPieConfig = {
            type: 'pie',
            data: rdvPieData,

            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };
        const myRdvPieChart = new Chart(
            document.getElementById('rdv-pie'),
            rdvPieConfig
        );


        //Type Service


        const typeData = {
            labels: typeServiceLabels,
            datasets: [{
                label: 'RDV par services',

                data: typeDataSource,
            }]
        };

        const typeService = {
            type: 'pie',
            data: typeData,

            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };
        const myTypeServiceChart = new Chart(
            document.getElementById('types'),
            typeService
        );


        //livraisons des passeport


        //-Ceux qui sont en attente


        const distributionData = {
            labels: labels,
            datasets: [{
                label: 'PRODUCTION',

                data: distributionPasseportDataSource,
            }]
        };

        const distrubitonItem = {
            type: 'bar',
            data: distributionData,
            horizontal: true,
            options: {
                indexAxis: 'y',
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };
        const mydistributionChart = new Chart(
            document.getElementById('distribution'),
            distrubitonItem
        );

        //waiting-passeport Passeport en attente

        const waintingPasseportData = {
            labels: labels,
            datasets: [{
                label: 'EN ATTENTE',
                borderColor: '#df8143',
                backgroundColor: '#df8143',
                data: distributionPasseportDataSource,
            }]
        };

        const waitingPasseportItem = {
            type: 'bar',
            data: waintingPasseportData,
            horizontal: true,
            options: {
                indexAxis: 'y',
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };
        const myWaitingPasseport = new Chart(
            document.getElementById('waiting-passeport'),
            waitingPasseportItem
        );


        //Groupe chart Data

        const fakeData = {
            labels: ['VIP', 'SANITAIRE'],
            datasets: [{
                label: 'Semaine 1',
                borderColor: '#df8143',
                backgroundColor: '#df8143',
                data: [300, 400, 700],
            }, {
                label: 'Semaine 2',
                borderColor: 'dodgerblue',
                backgroundColor: 'dodgerblue',
                data: [100, 300, 90],
            }, {
                label: 'Semaine 3',
                borderColor: 'green ',
                backgroundColor: 'green ',
                data: [50, 100, 200],
            }]
        };

        const fakeContainer = {
            type: 'bar',
            data: fakeData,

            options: {
                animations: {
                    tension: {
                        duration: 1000,
                        easing: 'linear',
                        from: 1,
                        to: 0,
                        loop: true
                    },

                },
            }
        };
        const fakeGroup = new Chart(
            document.getElementById('chart-group'),
            fakeContainer
        );
        const fakeGroup1 = new Chart(
            document.getElementById('chart-group1'),
            fakeContainer
        );
    </script>


@stop
