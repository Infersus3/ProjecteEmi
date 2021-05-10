@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="container-fluid">
                <!-- MISSATGES I ERRORS* -->
                @if ($errors->any())
                @foreach ($errors->all() as $message)
                <div class="d-flex align-items-center justify-content-center text-center">
                    <div class="col-lg-12 alert alert-danger">
                        <p> {{ $message }} </p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>

            <h3>Paràmetres generals</h3>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <form id="myform" action="{{ route ('edita_practica' ,['id' => $practica->id]) }}">
                            <div class="form-group">
                                <label for="labelNom">Nom de la mostra</label>
                                <input type="text" value="{{ $mostra->nom }}" name="nom_mostra" class="form-control" id="labelNom" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="labelCol">Alçada de la columna (mm)</label>
                                <input type="number" value="{{ $condicio->alçada_col }}" name="alçada_col" class="form-control" id="labelCol" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="labelTemp">Temperatura</label>
                                <input type="text" value="{{ $condicio->temperatura }}" name="temperatura" class="form-control" id="labelTemp" placeholder="" required>
                            </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                                <label for="labelNomCol">Nom de la columna</label>
                                <input type="text" value="{{ $condicio->nom_col }}" name="nom_col" class="form-control" id="labelNomCol" placeholder="" required>
                            </div>
                        <div class="form-group">
                            <label for="labelEluent">Eluent</label>
                            <input type="text" value="{{ $condicio->eluent }}" name="eluent" class="form-control" id="labelEluent" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="labelDiam">Diametre columna (mm)</label>
                            <input type="number" step="any" value="{{ $condicio->diametre_col }}" name="diametre_col" class="form-control" id="labelDiam" placeholder="" required>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="labelSpeed">Velocitat (ml/min)</label>
                            <input type="text" step="any" value="{{ $condicio->velocitat }}" name="velocitat" class="form-control" id="labelSpeed" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="labelDetector">Detector UV (nm)</label>
                            <input type="number" step="any" value="{{ $condicio->detector_uv }}" name="detector_uv" class="form-control" id="labelDetector" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="labelTamany">Tamany de la particula (µm)</label>
                            <input type="number" step="any" value="{{ $condicio->tamany }}" name="tamany" class="form-control" id="labelTamany" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="labelNeutre">Neutre</label>
                            <input type="text" name="neutre"  value="{{ $condicio->neutre }}" class="form-control" id="labelNeutre" placeholder="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="labelSelect">Selecció de compost</label><br>
                    @for ($i = 0; $i < count($arrayComposts); $i++)
                    @if ($compost_quimic[$i]->id == $arrayComposts[$i]->compost_quimic_id)
                        <label for="{{ $i }}">{{ $compost_quimic[$i]->nom }}</label>
                        <input class="cbox" type="checkbox" id="{{ $i }}" name="compost_q{{ $i }}" checked>
                        <input type="hidden" value="{{ $arrayComposts[$i]->id }}" name="idCompost{{ $i }}"></br>

                        <div class="form-group tr{{ $i }}">
                            <label for="labelTR{{ $i }}">Temps de retenció (TR)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_retencio }}" type="number" name="temps_retencio{{ $i }}" id="labelTR{{ $i }}" placeholder="">
                        </div>
                        <div class="form-group algraf{{ $i }}">
                            <label for="labelAlçGrafic{{ $i }}">Alçada del gràfic (mAU)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->alçada_grafic }}" type="number" name="alçada_grafic{{ $i }}" id="labelAlçGrafic{{ $i }}" placeholder="">
                        </div>
                        <div class="form-group ti{{ $i }}">
                            <label for="labelTI{{ $i }}">Temps Inicial (min)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_inicial }}" type="number" name="temps_inicial{{ $i }}" id="labelTI{{ $i }}" placeholder="">
                        </div>
                        <div class="form-group tf{{ $i }}">
                            <label for="labelTF{{ $i }}">Temps Final (min)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_final }}" type="number" name="temps_final{{ $i }}" id="labelTF{{ $i }}" placeholder="">
                        </div>
                </div>
                @endif
                @endfor
                <input type="hidden" value="{{ $mostra->id }}" name="mostraId">
                <input type="hidden" value="{{ $condicio->id }}" name="condicioId">
                <div class="form-group">
                    <label for="data_entrega">Data d'entrega</label>
                    <input class="form-control" value="{{ $practica->data_entrega }}" name="data_entrega" type="date" id="data_entrega" required>
                </div>
                <label for="labelVisible">Visible</label>
                <input type="checkbox" id="labelVisible" value="{{ $practica->visible }}" name="visiblebox"><br><br>
                <a href="{{ route('admin_practicas')}}" class="btn btn-secondary">Cancelar</a>
                <input type="submit" name="submit" class="btn btn-dark" onclick="alertame()" value="Envia"></input>

                </form>
            </div>
        </div>
    </div>
    <div id="chart" style="height: 00px; width:auto;"></div>
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
                datasets: [{
                    fill: false,
                    tension: 0.5,
                    symbolSize: 7,
                    animationEasing: 'cubicInOut',
                    label: 'Chromatogram',
                    yAxisID: 'Absorption',
                    data: [{
                            x: 0,
                            y: 0,
                        }, {
                            x: 0.2,
                            y: 2,
                        }, {
                            x: 0.6,
                            y: 0,
                        }, {
                            x: 1,
                            y: 0,
                        }, {
                            x: 2,
                            y: 10,
                        },
                        {
                            x: 2,
                            y: 0,
                        }, {
                            x: 3,
                            y: 0,
                        }, {
                            x: 3.5,
                            y: 2,
                        }, {
                            x: 4,
                            y: 0,
                        }, {
                            x: 5,
                            y: 0,
                        }, {
                            x: 6,
                            y: 0,
                        }, {
                            x: 6.2,
                            y: 2,
                        }, {
                            x: 6.6,
                            y: 0,
                        }, {
                            x: 7,
                            y: 0,
                        }, {
                            x: 8,
                            y: 10,
                        },
                        {
                            x: 8,
                            y: 0,
                        }, {
                            x: 9,
                            y: 0,
                        }, {
                            x: 9.5,
                            y: 2,
                        }, {
                            x: 10,
                            y: 0,
                        }, {
                            x: 11,
                            y: 0,
                        }
                    ],
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
            }
        });

        // === include 'setup' then 'config' above ===
    </script>
    <script>
        function alertame() {
            var values = $('#exampleFormControlSelect1').val();
            console.log(values);
        }
        $(document).ready(function() {
            $('input[type="checkbox"]').click(function(e) {
                var tar = e.target.id;
                if ($(".cbox").is(':checked')) {
                    $('.tr' + tar).css("display", "block");
                    $('.algraf' + tar).css("display", "block");
                    $('.ti' + tar).css("display", "block");
                    $('.tf' + tar).css("display", "block");
                } else {
                    $('.tr' + tar).css("display", "none");
                    $('.algraf' + tar).css("display", "none");
                    $('.ti' + tar).css("display", "none");
                    $('.tf' + tar).css("display", "none");
                }
            })
            if ($('#labelVisible').val()) {
                $('#labelVisible').prop( "checked", true );
            }
        });

        function unfoldVariables() {
            //var values = $(':checkbox');
            if (document.getElementById("cbox").checked == true) {
                $('.tr').css("display", "block");
                $('.algraf').css("display", "block");
            } else {
                $('.tr').css("display", "none");
                $('.algraf').css("display", "none");
            }
        }
    </script>

    <!--<script>
        

        

        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('grafic_tasca')",
            hooks: new ChartisanHooks()
                .datasets([{
                        type: 'line',
                        smooth: false,
                        fill: true,
                        lineStyle: {
                            width: 2
                        },
                        symbolSize: 7,
                        animationEasing: 'cubicInOut',
                        areaStyle: {
                            opacity: 0.8,
                            color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                                offset: 0,
                                color: 'rgba(128, 255, 165)'
                            }, {
                                offset: 1,
                                color: 'rgba(1, 191, 236)'
                            }])
                        }
                    },
                    'bar',
                ])
                .title({
                    textAlign: 'left',
                    text: "Grafic de mostres",
                })
                .tooltip()
                .axis({
                    yAxis: {
                        type: 'value',
                        yAxisIndex: 1,
                        name: 'Alçada',
                        position: 'left',
                        axisLine: {
                            show: true,
                        },
                        axisLabel: {
                            min: 0,
                            max: 50,
                        },
                    },
                    xAxis: {
                        xAxisIndex: 1,
                        name: 'T retencio (min)',
                        position: 'center',
                    }
                })

        });
    </script>-->
</div>
</div>
@endsection