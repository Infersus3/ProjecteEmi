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
                        <form id="myform" action="{{ route ('crear_practica') }}">
                            <div class="row">
                                <div class="col">

                                    <div class="form-group">
                                        <label for="labelNom">Nom mostra</label>
                                        <input type="text" name="nom_mostra" class="form-control" value="{{ old('nom_mostra') }}" id="labelNom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelCol">Longitud columna (mm)</label>
                                        <input type="number" name="alçada_col" class="form-control" value="{{ old('alçada_col') }}" id="labelCol" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelTemp">Temperatura</label>
                                        <input type="text" name="temperatura" class="form-control" value="{{ old('temperatura') }}" id="labelTemp" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="labelNomCol">Nom columna</label>
                                        <input type="text" name="nom_col" class="form-control" value="{{ old('nom_col') }}" id="labelNomCol" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelEluent">Eluent</label>
                                        <input type="text" name="eluent" class="form-control" value="{{ old('eluent') }}" id="labelEluent" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelDiam">Diàmetre columna (mm)</label>
                                        <input type="number" step="any" name="diametre_col" class="form-control" value="{{ old('diametre_col') }}" id="labelDiam" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="labelSpeed">Velocitat de flux (ml/min)</label>
                                        <input type="text" name="velocitat" class="form-control" value="{{ old('velocitat') }}" id="labelSpeed" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelDetector">Detector UV (nm)</label>
                                        <input type="number" step="any" name="detector_uv" class="form-control" value="{{ old('detector_uv') }}" id="labelDetector" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelTamany">Tamany de la particula (µm)</label>
                                        <input type="number" step="any" name="tamany" class="form-control" value="{{ old('tamany') }}" id="labelTamany" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelNeutre">Neutre</label>
                                        <input type="text" name="neutre" class="form-control" value="{{ old('neutre') }}" id="labelNeutre">
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
                                        <label for="labelAlçGrafic{{ $i }}">Alçada del gràfic (mm)</label>
                                        <input class="form-control" step="any" type="number" name="alçada_grafic{{ $i }}" value="{{ old('alçada_grafic$i') }}" id="labelAlçGrafic{{ $i }}">
                                    </div>
                                    <div style="display: none;" class="form-group ti{{ $i }}">
                                        <label for="labelTI{{ $i }}">Temps Inicial (min)</label>
                                        <input class="form-control" step="any" type="number" name="temps_inicial{{ $i }}" value="{{ old('temps_inicial$i') }}" id="labelTI{{ $i }}">
                                    </div>
                                    <div style="display: none;" class="form-group tf{{ $i }}">
                                        <label for="labelTF{{ $i }}">Temps Final (min)</label>
                                        <input class="form-control" step="any" type="number" name="temps_final{{ $i }}" value="{{ old('temps_final$i') }}" id="labelTF{{ $i }}">
                                    </div>
                                    @endfor
                                    @else
                                    <h5 id="nullCompostos" style="color:red;"> Necesites tenir mínim 1 compost</h5>
                                    @endif

                            </div>
                            <div class="form-group">
                                <label for="data_entrega">Data d'entrega</label>
                                <input class="form-control" name="data_entrega" type="date" value="{{ old('data_entrega') }}" id="data_entrega" required>
                            </div>
                            <label for="labelVisible">Visible</label>
                            <input type="checkbox" id="labelVisible" name="visiblebox"><br><br>
                            <a href="{{ route('admin_practicas')}}" class="btn btn-secondary">Cancelar</a>
                            <input type="submit" name="submit" class="btn btn-primary" value="Envia"></input>
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
            if ($('#' + tar).is(':checked')) {
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
        $('input[type="submit"]').click(function(e) {
            var compostsMinim = $('#nullCompostos');
            if (isset(compostsMinim)) {
                alert('Necesites tenir mínim 1 compost');
                console.log(compostsMinim);
                return false;
            }
        });
        if (!$('#labelVisible').prop("checked")) {
            $('#labelVisible').val(null);
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