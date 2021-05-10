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
                        <form id="myform" action="{{ route ('crear_practica') }}">
                            <div class="form-group">
                                <label for="labelNom">Nom de la mostra</label>
                                <input type="text" name="nom_mostra" class="form-control" value="{{ old('nom_mostra') }}" id="labelNom"  required>
                            </div>
                            <div class="form-group">
                                <label for="labelTemp">Temperatura</label>
                                <input type="text" name="temperatura" class="form-control" value="{{ old('temperatura') }}" id="labelTemp"  required>
                            </div>
                            <div class="form-group">
                                <label for="labelCol">Alçada de la columna (mm)</label>
                                <input type="number" name="alçada_col" class="form-control" value="{{ old('alçada_col') }}" id="labelCol"  required>
                            </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                                <label for="labelNomCol">Nom de la columna</label>
                                <input type="text" name="nom_col" class="form-control" value="{{ old('nom_col') }}" id="labelNomCol"  required>
                            </div>
                        <div class="form-group">
                            <label for="labelEluent">Eluent</label>
                            <input type="text" name="eluent" class="form-control" value="{{ old('eluent') }}" id="labelEluent"  required>
                        </div>
                        <div class="form-group">
                            <label for="labelDiam">Diametre columna (mm)</label>
                            <input type="number" step="any" name="diametre_col" class="form-control" value="{{ old('diametre_col') }}" id="labelDiam"  required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="labelSpeed">Velocitat (ml/min)</label>
                            <input type="text" name="velocitat" class="form-control" value="{{ old('velocitat') }}" id="labelSpeed"  required>
                        </div>
                        <div class="form-group">
                            <label for="labelDetector">Detector UV (nm)</label>
                            <input type="number" step="any" name="detector_uv" class="form-control" value="{{ old('detector_uv') }}" id="labelDetector" required>
                        </div>
                        <div class="form-group">
                            <label for="labelTamany">Tamany de la particula (µm)</label>
                            <input type="number" step="any" name="tamany" class="form-control" value="{{ old('tamany') }}" id="labelTamany"  required>
                        </div>
                        <div class="form-group">
                            <label for="labelNeutre">Neutre</label>
                            <input type="text" name="neutre" class="form-control" value="{{ old('neutre') }}" id="labelNeutre" >
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="labelSelect">Selecció de compost</label><br>
                    @if (count($compost_quimic))
                    @for ($i = 0; $i < count($compost_quimic); $i++) <label for="{{ $i }}">{{ $compost_quimic[$i]->nom }}</label>
                        <input class="cbox" type="checkbox" id="{{ $i }}" name="compost_q{{ $i }}">
                        <input type="hidden" value="{{ $compost_quimic[$i]->id }}" name="idCompost{{ $i }}"></br>
                        <div style="display: none;" class="form-group tr{{ $i }}">
                            <label for="labelTR{{ $i }}">Temps de retenció (TR)</label>
                            <input class="form-control" step="any" type="number" name="temps_retencio{{ $i }}" value="{{ old('temps_retencio$i') }}" id="labelTR{{ $i }}">
                        </div>
                        <div style="display: none;" class="form-group algraf{{ $i }}">
                            <label for="labelAlçGrafic{{ $i }}">Alçada del gràfic (mAU)</label>
                            <input class="form-control" step="any" type="number" name="alçada_grafic{{ $i }}" value="{{ old('alçada_grafic$i') }}" id="labelAlçGrafic{{ $i }}">
                        </div>
                        <div style="display: none;" class="form-group ti{{ $i }}">
                            <label for="labelTI{{ $i }}">Temps Inicial (min)</label>
                            <input class="form-control" step="any" type="number" name="temps_inicial{{ $i }}" value="{{ old('temps_inicial$i') }}" id="labelTI{{ $i }}" >
                        </div>
                        <div style="display: none;" class="form-group tf{{ $i }}">
                            <label for="labelTF{{ $i }}">Temps Final (min)</label>
                            <input class="form-control" step="any" type="number" name="temps_final{{ $i }}" value="{{ old('temps_final$i') }}" id="labelTF{{ $i }}" >
                        </div>
                        @endfor
                    @else
                        <h5 id="nullCompostos" style="color:red;"> Necesites tenir mínim 1 compost</h5>
                    @endif

                </div>
                <!-- <div class="form-group">
                    <label for="labelSelect">Selecció de compost</label>
                    <select class="form-control" name="compost_q[]" id="labelSelect" multiple>
                        @foreach($compost_quimic ?? '' as $compost)
                        <option value="{{ $compost->id }}">{{ $compost->nom }}</option>
                        @endforeach
                    </select>
                </div> -->

                <div class="form-group">
                    <label for="data_entrega">Data d'entrega</label>
                    <input class="form-control" name="data_entrega" type="date" value="{{ old('data_entrega') }}" id="data_entrega" required>
                </div>
                <label for="labelVisible">Visible</label>
                <input type="checkbox" id="labelVisible" name="visiblebox"><br><br>
                <input type="submit" name="submit" class="btn btn-dark" value="Envia"></input>
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
    <script>
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
                    $('.ti' + tar).css("display", "block");
                    $('.tf' + tar).css("display", "block");
                }
            });
            $('input[type="submit"]').click(function(e) {
                var compostsMinim = $('#nullCompostos');
                if (isset(compostsMinim)){
                    alert('Necesites tenir mínim 1 compost');
                    console.log(compostsMinim);
                    return false;
                }
            });
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