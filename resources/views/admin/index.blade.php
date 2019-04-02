@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Информация</h1>
        </div>
        <div class="stat border-bottom">
            <h3>Статистика серверов</h3>
        </div>
        <br>

        <div class="reg border-bottom">
            <h3>Статистика регистараций на сервере</h3>
        </div>
        <canvas class="my-4 w-100 chartjs-render-monitor" id="RegTable" width="600" height="250" style="display: block; height: 275px; width: 652px;"></canvas>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
    <script>
        var sunday = 1;
        var monday = 7;
        var tuesday = 9;
        var wednesday = 700;
        var thursday = 106;
        var fridey = 73;
        var saturday = 130;

        (function () {
            'use strict'

            feather.replace()

            // Graphs
            var ctx = document.getElementById('RegTable');
            // eslint-disable-next-line no-unused-vars
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'Воскресенье',
                        'Понедельник',
                        'Вторник',
                        'Среда',
                        'Четверг',
                        'Пятница',
                        'Суббота'
                    ],
                    datasets: [{
                        data: [
                            sunday,
                            monday,
                            tuesday,
                            wednesday,
                            thursday,
                            fridey,
                            saturday
                        ],
                        lineTension: 0,
                        backgroundColor: 'transparent',
                        borderColor: '#007bff',
                        borderWidth: 4,
                        pointBackgroundColor: '#007bff'
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: false
                            }
                        }]
                    },
                    legend: {
                        display: false
                    }
                }
            })
        }());

        document.getElementById('home').setAttribute('class', 'nav-link active');
    </script>
@endsection