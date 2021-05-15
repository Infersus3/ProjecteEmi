@extends('layouts.app')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                        <form id="myform" action="{{ route ('realitza_tasca' ,['id' => $tasca->id]) }}">
                            <div style="width: 1000px; height:500px;">
                                <canvas id="myChart"></canvas>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label class="form-check-label" for="labelSelect">Selecció de compost</label><br>
                                @for ($i = 0; $i < count($arrayComposts); $i++) @foreach ($compost_quimic as $compostos) @if ($compostos->id == $arrayComposts[$i]->compost_quimic_id)
                                    <label for="{{ $i }}">{{ $compost_quimic[$i]->nom }}</label>
                                    <input class="cbox" type="checkbox" id="{{ $i }}" name="compost_q{{ $i }}" checked>
                                    <input type="hidden" value="{{ $arrayComposts[$i]->id }}" name="idCompost{{ $i }}"></br>
                                    <input type="hidden" value="{{ count($arrayComposts) }}" id="maxArray">
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
                            @endif
                            @endforeach
                            @endfor
                            <input type="submit" name="submit" class="btn btn-dark" onclick="alertame()" value="Envia"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
                $('.ti' + tar).css("display", "none");
                $('.tf' + tar).css("display", "none");
            }
        })
        if ($('#labelVisible').val()) {
            $('#labelVisible').prop("checked", true);
        }

        var xIni;
        var yIni = 0;
        var xRetencio;
        var xFinal;
        var yFinal = 0;
        var yAlçada;
        var array1 = [];
        var array2 = [];
        var array3 = [];
        var arrayVariables = [];

        var arra = [10, 12, 20, 52, 12, 51, 62, 12, 56, 78];
        var valorMax = $("#maxArray").val();
  
        for (let i = 0; i < valorMax; i++) {
            array1 = [];
            array2 = [];
            array3 = [];
            xIni = document.getElementById("labelTI" + i).value;
            xRetencio = document.getElementById("labelTR" + i).value;
            xFinal = document.getElementById("labelTF" + i).value;
            yAlçada = document.getElementById("labelAlçGrafic" + i).value;
            array1.push(xIni, yIni);
            array2.push(xRetencio, yAlçada);
            array3.push(xFinal, yFinal);
            arrayVariables.push(array1, array2, array3);
            console.log(array1);
            console.log(array2);
            console.log(array3);
        }

        console.log(arrayVariables);
        var jsonArray = JSON.stringify(arrayVariables);
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'scatter',
            data: {
                datasets: [{
                    fill: false,
                    tension: 0.5,
                    symbolSize: 7,
                    animationEasing: 'cubicInOut',
                    label: 'Cromatograma HPLC',
                    yAxisID: 'Alçada del grafic',
                    data: arrayVariables,
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
        myChart.render();
    });
</script>
@endsection