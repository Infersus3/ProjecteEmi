@extends('layouts.app')

@section('content')
<div class="wrapper-sm">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pràctiques d'alumnes:  {{ $practica[0]->titol ?? '' }}</h5>
        </div>
        <div class="card-body">
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <h3>{{ $practica->titol }}</h3>
                        <p class="data"> Data final d'entrega: {{ date("d-m-Y", strtotime($practica->data_entrega)) }} </p>
                    </tr>
                    <p> Alumnes: </p>
                    @foreach ($tasquesOrd as $tasca)
                    @if ($practica->id == $tasca->practica_id)
                    <tr>
                        @if ($tasca->alumne_id)
                        @foreach ($alumnes as $alumne)
                        @if ($alumne->id == $tasca->alumne_id)
                        @php $in = 1; @endphp
                        <td>
                            <div class="btn"><h5> {{ $alumne->nom }}</h5></div>
                        </td>
                        <td>
                            <a href="{{ route('avaluar', ['id' => $tasca->id]) }}" class="btn btn-info"><i class="fas fa-tasks"></i> Avaluar</a>
                        </td>
                        @endif
                        @endforeach
                        @endif
                    <tr>
                        @endif
                        @endforeach
                </table>
                <table class="table table-responsive">
                    <p> Grups: </p>
                    @foreach ($tasquesOrd as $tasca)
                    @if ($practica->id == $tasca->practica_id)
                    <tr>
                        @if ($tasca->grup_id)
                        @foreach ($grups as $grup)
                        @if ($grup->id == $tasca->grup_id)
                        <td>
                            <div class="btn"><h5> {{ $grup->nom }}</h5></div>
                        </td>
                        <td>
                            <a href="{{ route('avaluar', ['id' => $tasca->id]) }}" class="btn btn-info"><i class="fas fa-tasks"></i> Avaluar</a>
                        </td>
                        @endif
                        @endforeach
                        @endif
                    <tr>
                        @endif
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection