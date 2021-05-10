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
                        <form id="myform" action="{{ route ('realitza_tasca' ,['id' => $tasca->id]) }}">
                            <div class="form-group">
                                <label for="labelNom">Nom de la mostra</label>
                                <input type="text" readonly value="{{ $mostra->nom }}" name="nom_mostra" class="form-control" id="labelNom" required>
                            </div>
                            <div class="form-group">
                                <label for="labelCol">Alçada de la columna (mm)</label>
                                <input type="number" name="alçada_col" class="form-control" id="labelCol" required>
                            </div>
                            <div class="form-group">
                                <label for="labelTemp">Temperatura</label>
                                <input type="text" name="temperatura" class="form-control" id="labelTemp" required>
                            </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="labelNomCol">Nom de la columna</label>
                            <input type="text" name="nom_col" class="form-control" id="labelNomCol" required>
                        </div>
                        <div class="form-group">
                            <label for="labelEluent">Eluent</label>
                            <input type="text" name="eluent" class="form-control" id="labelEluent" required>
                        </div>
                        <div class="form-group">
                            <label for="labelDiam">Diametre columna (mm)</label>
                            <input type="number" step="any" name="diametre_col" class="form-control" id="labelDiam" required>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="labelSpeed">Velocitat (ml/min)</label>
                            <input type="text" step="any" name="velocitat" class="form-control" id="labelSpeed" required>
                        </div>
                        <div class="form-group">
                            <label for="labelDetector">Detector UV (nm)</label>
                            <input type="number" step="any" name="detector_uv" class="form-control" id="labelDetector" required>
                        </div>
                        <div class="form-group">
                            <label for="labelTamany">Tamany de la particula (µm)</label>
                            <input type="number" step="any" name="tamany" class="form-control" id="labelTamany" required>
                        </div>
                        @if($condN)
                        <div class="form-group">
                            <label for="labelNeutre">Neutre</label>
                            <input type="text" name="neutre" class="form-control" id="labelNeutre">
                        </div>
                        @endif
                    </div>
                </div>
                @if ($practica->visible)
                <div class="form-group">
                    <label class="form-check-label" for="labelSelect">Selecció de compost</label><br>
                    @for ($i = 0; $i < count($arrayComposts); $i++) @if ($compost_quimic[$i]->id == $arrayComposts[$i]->compost_quimic_id)
                        <label for="{{ $i }}">{{ $compost_quimic[$i]->nom }}</label>
                        <input class="cbox" type="checkbox" id="{{ $i }}" name="compost_q{{ $i }}" checked>
                        <input type="hidden" value="{{ $arrayComposts[$i]->id }}" name="idCompost{{ $i }}"></br>

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
                </div>
                @endif
                @endfor
                @endif
                <input type="hidden" value="{{ $mostra->id }}" name="mostraId">
                <div class="form-group" style="display: none;">
                    <label for="data_entrega">Data d'entrega</label>
                    <input class="form-control" value="{{ $practica->data_entrega }}" name="data_entrega" type="date" id="data_entrega" required>
                </div>

                <input type="submit" name="submit" class="btn btn-dark" onclick="alertame()" value="Envia"></input>

                </form>
            </div>
        </div>
    </div>
    @endsection
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
                    $('.ti' + tar).css("display", "none");
                    $('.tf' + tar).css("display", "none");
                }
            })
            if ($('#labelVisible').val()) {
                $('#labelVisible').prop("checked", true);
            }
        });
    </script>