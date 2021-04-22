@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


            @if (Route::has('login'))
            <h3>Paràmetres generals</h3>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nom de la mostra</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alçada de la columna (mm)</label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Temperatura</label>
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                            </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Eluent</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>


                        <div class="form-group">
                            <label for="exampleFormControlInput1">Diametre columna (mm)</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Velocitat (ml/min)</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Detector UV (nm)</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Tamany de la particula (µm)</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Selecció de compost</label>
                    <select class="form-control" id="exampleFormControlSelect1" multiple>
                        @foreach($compost_quimic ?? '' as $compost)
                        <option value="{{ $compost->id }}">{{ $compost->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Comentari</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-dark" onclick="alertame()">Envia</button>
                </form>
            </div>
        </div>
        @else
        {{ __('No estas loguejat!') }}



        @endif
    </div>
    <!--div id="chart" style="height: 500px; width:auto;"></div-->
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>




    <div>
        <canvas id="myChart" style="height: 400px;"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'scatter',
            data: {
                labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', ],
                datasets: [{
                    fill: false,
                    label: 'Chromatogram',
                    yAxisID: 'Absorption',
                    data: [0, 10, 15, 20, 23, 30, 35,2], //chromatogram_iso,
                    borderColor: 'rgb(51, 102, 255)',
                    showLine: true,
                    pointRadius: 0,
                    borderWidth: 2,
                    cubicInterpolationMode: 'linear',
                    steppedLine: 'after'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1
                },
                scales: {
                    xAxes: [{
                        type: 'linear',
                        position: 'bottom',
                        id: 'Void'
                    }],
                    yAxes: [{
                        position: 'right',
                        id: "Absorption",
                        gridLines: {
                            drawOnChartArea: false
                        },
                    }, {
                        position: 'right',
                        id: "Backpressure",
                        gridLines: {
                            drawOnChartArea: false
                        },
                        ticks: {
                            max: 6e3,
                            min: 0
                        }
                    }]
                }
            }
        });

        // === include 'setup' then 'config' above ===
    </script>



    <script>
        function alertame() {
            //var v = document.getElementById("exampleFormControlSelect1");
            var values = $('#exampleFormControlSelect1').val();
            console.log(values);
        }
    </script>

</div>
</div>
@endsection