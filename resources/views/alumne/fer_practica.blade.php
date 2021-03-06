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

            <div class="card-form">
                <div class="card-header">
                    <h4>Paràmetres generals</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <form id="myform" method="POST" action="{{ route ('realitza_tasca_post' ,['id' => $tasca->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="labelNom">Nom mostra</label>
                                        <input type="text" readonly value="{{ $mostra->nom }}" name="nom_mostra" class="form-control" id="labelNom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelCol">Longitud columna (mm)</label>
                                        <input type="number" name="alçada_col" value="{{ $condicioAlumne->alçada_col ?? '' }}" class="form-control" id="labelCol" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelTemp">Temperatura</label>
                                        <input type="text" name="temperatura" value="{{ $condicioAlumne->temperatura ?? '' }}" class="form-control" id="labelTemp" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="labelNomCol">Nom columna</label>
                                        <input type="text" name="nom_col" value="{{ $condicioAlumne->nom_col ?? '' }}" class="form-control" id="labelNomCol" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelEluent">Eluent</label>
                                        <input type="text" name="eluent" value="{{ $condicioAlumne->eluent ?? '' }}" class="form-control" id="labelEluent" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelDiam">Diàmetre columna (mm)</label>
                                        <input type="number" step="any" name="diametre_col" value="{{ $condicioAlumne->diametre_col ?? '' }}" class="form-control" id="labelDiam" required>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="labelSpeed">Velocitat de flux (ml/min)</label>
                                        <input type="text" step="any" name="velocitat" value="{{ $condicioAlumne->velocitat ?? '' }}" class="form-control" id="labelSpeed" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelDetector">Detector UV (nm)</label>
                                        <input type="number" step="any" name="detector_uv" value="{{ $condicioAlumne->detector_uv ?? '' }}" class="form-control" id="labelDetector" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelTamany">Tamany de la particula (µm)</label>
                                        <input type="number" step="any" name="tamany" value="{{ $condicioAlumne->tamany ?? '' }}" class="form-control" id="labelTamany" required>
                                    </div>
                                    @if($condN)
                                    <div class="form-group">
                                        <label for="labelNeutre">Neutre</label>
                                        <input type="text" name="neutre" value="{{ $condicioAlumne->neutre ?? '' }}" class="form-control" id="labelNeutre">
                                    </div>
                                    @endif
                                    <input type="hidden" id="comprovarCond" action="{{ route ('comprovar_cond' ,['id' => $practica->id]) }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="labelComent">Comentari</label>
                                <textarea rows="7" cols="85" name="comentari" class="form-control" id="labelComent">{{ $tasca->comentari }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="labelDoc">Pujar arxiu amb fórmules</label> <br>
                                @if ($tasca->document)
                                <p class=" btn btn-success"> Arxiu pujat correctament </p> <br>
                                <a href="{{ asset($tasca->document) }}" download> {{ $tasca->document }} <img src="{{ asset('img/download_icon.png')}}" class="download_icon" alt=""></a>
                                @endif
                                <input type="file" name="doc" class="form-control" id="labelDoc">
                            </div>
                            @if ($practica->visible || $practica->data_entrega < $data) <div class="form-group">
                                @else
                                <div class="form-group" style="display: none;">
                                    @endif
                                    <label class="form-check-label" for="labelSelect">Selecció de compost</label><br>
                                    @for ($i = 0; $i < count($arrayComposts); $i++) @foreach ($compost_quimic as $compost) @if ($compost->id == $arrayComposts[$i]->compost_quimic_id)
                                        <label for="{{ $i }}">{{ $compost->nom }}</label>
                                        <input class="cbox" type="checkbox" id="{{ $i }}" name="compost_q{{ $i }}" checked>
                                        <input type="hidden" value="{{ $arrayComposts[$i]->id }}" name="idCompost{{ $i }}"></br>
                                        <input type="hidden" value="{{ count($arrayComposts) }}" id="maxArray">

                                        <div class="form-group tr{{ $i }}">
                                            <label for="labelTR{{ $i }}">Temps de retenció (TR)</label>
                                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_retencio }}" type="number" name="temps_retencio{{ $i }}" id="labelTR{{ $i }}" readonly>
                                        </div>
                                        <div class="form-group algraf{{ $i }}">
                                            <label for="labelAlçGrafic{{ $i }}">Alçada del gràfic (mAU)</label>
                                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->alçada_grafic }}" type="number" name="alçada_grafic{{ $i }}" id="labelAlçGrafic{{ $i }}" readonly>
                                        </div>
                                        <div class="form-group ti{{ $i }}">
                                            <label for="labelTI{{ $i }}">Temps Inicial (min)</label>
                                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_inicial }}" type="number" name="temps_inicial{{ $i }}" id="labelTI{{ $i }}" readonly>
                                        </div>
                                        <div class="form-group tf{{ $i }}">
                                            <label for="labelTF{{ $i }}">Temps Final (min)</label>
                                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_final }}" type="number" name="temps_final{{ $i }}" id="labelTF{{ $i }}" readonly>
                                        </div>
                                        @endif
                                        @endforeach
                                        @endfor
                                        <input type="hidden" value="{{ $mostra->id }}" name="mostraId">
                                        <div class="form-group" style="display: none;">
                                            <label for="data_entrega">Data d'entrega</label>
                                            <input class="form-control" value="{{ $practica->data_entrega }}" name="data_entrega" type="date" id="data_entrega" required>
                                        </div>
                                </div>
                                <a href="{{ route('tasques_alumne')}}" class="btn btn-secondary">Cancelar</a>
                                <input type="button" class="btn btn-success" value="Veure Gràfic" id="createButton">
                                @if ($practica->data_entrega > $data)
                                <input type="submit" name="submit" class="btn btn-primary" id="submit" value="Envia"></input>
                                @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--Modal para CRUD CREATE-->
<div class="modal fade" id="modalCRUD_grafic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Gràfic </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal">
                <canvas id="myChart"></canvas>
                <div id="min-grafic" class="d-flex justify-content-center min-grafic">Temps(min)</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<!-- Aquí acaba -->
@endsection

@section('scripts')

<!-- Charting library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {


        $('input[type="checkbox"]').click(function(e) {
            var tar = e.target.id;
            if ($("#" + tar).is(':checked')) {
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
        });

        function validarCondicions() {
            var url = $("#comprovarCond").attr('action');
            $.ajax({
                url: url,
                type: "GET",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult) {
                    if (dataResult['condicio']['alçada_col'] == $('#labelCol').val() &&
                        dataResult['condicio']['temperatura'] == $('#labelTemp').val() &&
                        dataResult['condicio']['eluent'] == $('#labelEluent').val() &&
                        dataResult['condicio']['diametre_col'] == $('#labelDiam').val() &&
                        dataResult['condicio']['tamany'] == $('#labelTamany').val() &&
                        dataResult['condicio']['velocitat'] == $('#labelSpeed').val() &&
                        dataResult['condicio']['detector_uv'] == $('#labelDetector').val() &&
                        dataResult['condicio']['neutre'] == $('#labelNeutre').val()) {
                        makeGrafic(true);

                    } else {
                        if ($('#submit').length == 0) {
                            if (dataResult['condicio']['alçada_col'] != $('#labelCol').val()) {
                                $('#labelCol').addClass('is-invalid');
                            }
                            if (dataResult['condicio']['alçada_col'] != $('#labelTemp').val()) {
                                $('#labelTemp').addClass('is-invalid');
                            }
                            if (dataResult['condicio']['alçada_col'] != $('#labelEluent').val()) {
                                $('#labelEluent').addClass('is-invalid');
                            }
                            if (dataResult['condicio']['alçada_col'] != $('#labelDiam').val()) {
                                $('#labelDiam').addClass('is-invalid');
                            }
                            if (dataResult['condicio']['alçada_col'] != $('#labelTamany').val()) {
                                $('#labelTamany').addClass('is-invalid');
                            }
                            if (dataResult['condicio']['alçada_col'] != $('#labelSpeed').val()) {
                                $('#labelSpeed').addClass('is-invalid');
                            }
                            if (dataResult['condicio']['alçada_col'] != $('#labelDetector').val()) {
                                $('#labelDetector').addClass('is-invalid');
                            }
                            if (dataResult['condicio']['alçada_col'] != $('#labelNeutre').val()) {
                                $('#labelNeutre').addClass('is-invalid');
                            }
                        }
                        makeGrafic(false);
                    }


                }
            });
        }

        $(document).on('click', '#createButton', function() {
            validarCondicions();
            $("#modalCRUD_grafic").modal("show");
        });


        // GRÀFIC
        function makeGrafic(ok) {
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

            var arrayFail = [
                [1, 1],
                [2, 1],
                [3, 1],
                [4, 1],
                [5, 1],
                [6, 1],
                [7, 1][8, 1]
            ];
            var valorMax = document.getElementById("maxArray").value;

            if (ok) {
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
                }
            } else {
                arrayVariables = arrayFail.slice();
            }

            //Reiniciem el gràfic perquè pugui tenir valors nous.
            $('#myChart').remove();
            $("#min-grafic").remove();
            $('#modal').append("<canvas id=\"myChart\"></canvas><div id=\"min-grafic\" class=\"d-flex justify-content-center" +
                " min-grafic\">Temps(min)</div>");
            var ctx = document.getElementById('myChart');
            var myChart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: [{
                        fill: false,
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
        }
        validarCondicions();
    });
</script>
@endsection