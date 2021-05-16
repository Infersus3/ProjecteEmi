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
                                <input type="text" value="{{ $mostra->nom }}" name="nom_mostra" class="form-control" id="labelNom" required>
                            </div>
                            <div class="form-group">
                                <label for="labelCol">Alçada de la columna (mm)</label>
                                <input type="number" value="{{ $condicio->alçada_col }}" name="alçada_col" class="form-control" id="labelCol" required>
                            </div>
                            <div class="form-group">
                                <label for="labelTemp">Temperatura</label>
                                <input type="text" value="{{ $condicio->temperatura }}" name="temperatura" class="form-control" id="labelTemp" required>
                            </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="labelNomCol">Nom de la columna</label>
                            <input type="text" value="{{ $condicio->nom_col }}" name="nom_col" class="form-control" id="labelNomCol" required>
                        </div>
                        <div class="form-group">
                            <label for="labelEluent">Eluent</label>
                            <input type="text" value="{{ $condicio->eluent }}" name="eluent" class="form-control" id="labelEluent" required>
                        </div>
                        <div class="form-group">
                            <label for="labelDiam">Diametre columna (mm)</label>
                            <input type="number" step="any" value="{{ $condicio->diametre_col }}" name="diametre_col" class="form-control" id="labelDiam" required>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="labelSpeed">Velocitat (ml/min)</label>
                            <input type="text" step="any" value="{{ $condicio->velocitat }}" name="velocitat" class="form-control" id="labelSpeed" required>
                        </div>
                        <div class="form-group">
                            <label for="labelDetector">Detector UV (nm)</label>
                            <input type="number" step="any" value="{{ $condicio->detector_uv }}" name="detector_uv" class="form-control" id="labelDetector" required>
                        </div>
                        <div class="form-group">
                            <label for="labelTamany">Tamany de la particula (µm)</label>
                            <input type="number" step="any" value="{{ $condicio->tamany }}" name="tamany" class="form-control" id="labelTamany" required>
                        </div>
                        <div class="form-group">
                            <label for="labelNeutre">Neutre</label>
                            <input type="text" name="neutre" value="{{ $condicio->neutre }}" class="form-control" id="labelNeutre">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-check-label" for="labelSelect">Selecció de compost</label><br>
                    @for ($i = 0; $i < count($arrayComposts); $i++) @foreach ($compost_quimic as $compost) @if ($compost->id == $arrayComposts[$i]->compost_quimic_id)
                        <label for="{{ $i }}">{{ $compost->nom }}</label>
                        <input class="cboxOn" type="checkbox" id="{{ $i }}" name="compost_q{{ $i }}" checked>
                        <input type="hidden" value="{{ $compost->id }}" name="idCompost{{ $i }}"></br>
                        <input type="hidden" value="{{ $arrayComposts[$i]->id }}" name="idMostraCondCompost{{ $i }}">
                        <div class="form-group tr{{ $i }}">
                            <label for="labelTR{{ $i }}">Temps de retenció (TR)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_retencio }}" type="number" name="temps_retencio{{ $i }}" id="labelTR{{ $i }}">
                        </div>
                        <div class="form-group algraf{{ $i }}">
                            <label for="labelAlçGrafic{{ $i }}">Alçada del gràfic (mAU)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->alçada_grafic }}" type="number" name="alçada_grafic{{ $i }}" id="labelAlçGrafic{{ $i }}">
                        </div>
                        <div class="form-group ti{{ $i }}">
                            <label for="labelTI{{ $i }}">Temps Inicial (min)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_inicial }}" type="number" name="temps_inicial{{ $i }}" id="labelTI{{ $i }}">
                        </div>
                        <div class="form-group tf{{ $i }}">
                            <label for="labelTF{{ $i }}">Temps Final (min)</label>
                            <input class="form-control" step="any" value="{{ $arrayComposts[$i]->temps_final }}" type="number" name="temps_final{{ $i }}" id="labelTF{{ $i }}">
                        </div>

                        @endif
                        @endforeach
                        @endfor
                        @for ($i = 0; $i < count($compost_quimic); $i++) @php $in=0; foreach ($arrayComposts as $compostos){ if ($compostos->compost_quimic_id == $compost_quimic[$i]->id){
                            $in = 1;
                            }
                            }
                            @endphp

                            @if ($in == 0)
                            <label for="0{{ $i }}">{{ $compost_quimic[$i]->nom }}</label>
                            <input class="cboxOf" type="checkbox" id="0{{ $i }}" name="compost_q0{{ $i }}">
                            <input type="hidden" value="{{ $compost_quimic[$i]->id }}" name="idCompost0{{ $i }}"></br>

                            <div class="form-group tr0{{ $i }}" style="display:none">
                                <label for="labelTR{{ $i }}">Temps de retenció (TR)</label>
                                <input class="form-control" step="any" type="number" name="temps_retencio0{{ $i }}" id="labelTR0{{ $i }}">
                            </div>
                            <div class="form-group algraf0{{ $i }}" style="display:none">
                                <label for="labelAlçGrafic{{ $i }}">Alçada del gràfic (mAU)</label>
                                <input class="form-control" step="any" type="number" name="alçada_grafic0{{ $i }}" id="labelAlçGrafic0{{ $i }}">
                            </div>
                            <div class="form-group ti0{{ $i }}" style="display:none">
                                <label for="labelTI{{ $i }}">Temps Inicial (min)</label>
                                <input class="form-control" step="any" type="number" name="temps_inicial0{{ $i }}" id="labelTI0{{ $i }}">
                            </div>
                            <div class="form-group tf0{{ $i }}" style="display:none">
                                <label for="labelTF{{ $i }}">Temps Final (min)</label>
                                <input class="form-control" step="any" type="number" name="temps_final0{{ $i }}" id="labelTF0{{ $i }}">
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
</div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Composts que estan a la pràctica
        $('input[class="cboxOn"]').click(function(e) {
            var tar = e.target.id;
            if ($(".cboxOn").is(':checked')) {
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

        // Composts que no estan a la pràctica
        $('input[class="cboxOf"]').click(function(e) {
            var tar = e.target.id;
            if ($(".cboxOf").is(':checked')) {
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
        if ($('#labelVisible').val()) {
            $('#labelVisible').prop("checked", true);
        }

        $('#labelVisible').on('click', function() {
            if ($('#labelVisible').prop("checked")) {
                $('#labelVisible').val(1);
            } else {
                $('#labelVisible').val(null);
            }
        });
    });
</script>
@endsection