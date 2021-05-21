@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $practica->titol }}</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <h3>Alumnes</h3>
                        <table class="table table-responsive">
                            @foreach ($tasques as $tasca)
                            @foreach ($alumnes as $alumne)
                            @if ($alumne->id == $tasca->alumne_id)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }}</h5>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger delAlumne" href="{{ route('delete_alumne_tasca', ['practica_id' => $practica->id, 'tasca_id' => $tasca->id]) }}" value="{{ $alumne->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                        </table>
                        <h3> Grups</h3>
                        <table class="table table-responsive">
                            @foreach ($tasques as $tasca)
                            @foreach ($grups as $grup)
                            @if ($grup->id == $tasca->grup_id)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $grup->nom }}</h5>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger delGrup" href="{{ route('delete_alumne_tasca', ['practica_id' => $practica->id, 'tasca_id' => $tasca->id]) }}" value="{{ $grup->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Alumnes</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-responsive">
                            @foreach ($alumnes as $alumne)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }}</h5>
                                </td>
                                @if (count($tasques))
                                @php $in = 0;
                                foreach ($tasques as $tasca){
                                if ($alumne->id == $tasca->alumne_id){
                                $in = 1;}}
                                @endphp
                                @if (!$in)
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('create_alumne_tasca', ['practica_id' => $practica->id, 'alumne_id' => $alumne->id])}}"> Assignar </a>
                                </td>
                                @else
                                <td>
                                    <p>ja té la pràctica assignada</p>

                                </td>
                                @endif
                                @else
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('create_alumne_tasca', ['practica_id' => $practica->id, 'alumne_id' => $alumne->id])}}"> Assignar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="card" style="margin-top: 20px;">
                <div class="card-header">
                    <h5 class="card-title">Grups</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-responsive">
                            @foreach ($grups as $grup)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $grup->nom }}</h5>
                                </td>
                                @if (count($tasques))
                                @php $in = 0;
                                foreach ($tasques as $tasca){
                                if ($grup->id == $tasca->grup_id){
                                $in = 1;}
                                }
                                @endphp
                                @if (!$in)
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('create_alumne_tasca', ['practica_id' => $practica->id, 'grup_id' => $grup->id])}}"> Assignar </a>
                                </td>
                                @else
                                <td>
                                    <p>ja té la pràctica assignada</p>
                                </td>
                                @endif
                                @else
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('create_alumne_tasca', ['practica_id' => $practica->id, 'grup_id' => $grup->id])}}"> Assignar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('.delAlumne').on('click', function() {
            let alumne = $(this).attr('value');
            return window.confirm('Segur que vols esborrar la tasca de l\'usuari: \'' + alumne + '\' ? S\'eliminarà l\'informació de la tasca que ha fet.');
        });

        $('.delGrup').on('click', function() {
            let grup = $(this).attr('value');
            return window.confirm('Segur que vols esborrar la tasca del grup: ' + grup + ' ? S\'eliminarà l\'informació de la tasca que han fet.');
        });
    })
</script>
@endsection