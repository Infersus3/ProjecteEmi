@extends('layouts.app')

@section('content')
<div class="wrapper-sm">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Tàsques d'alumnes</h5>
        </div>
        <div class="card-body">
            @foreach ($practiques as $practica)
                @php $in = 0; @endphp
            <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <p> {{ date("d-m-Y", strtotime($practica->data_entrega)) }} </p>
                        <h5>{{ $practica->titol }}</h5>
                    </tr>
                    @foreach ($tasques as $tasca)
                    @if ($practica->id == $tasca->practica_id)
                    <tr>
                        @if ($tasca->alumne_id)
                        @foreach ($alumnes as $alumne)
                        @if ($alumne->id == $tasca->alumne_id)
                        @php $in = 1; @endphp
                        <td>
                            <p>Alumne: {{ $alumne->nom }}</p>
                        </td>
                        <td>
                            <a href="{{ route('avaluar', ['id' => $tasca->id]) }}" class="btn btn-sm btn-info">Avaluar</a>
                        </td>
                        @endif
                        @endforeach
                        @endif
                    <tr>
                        @endif
                        @endforeach
                </table>
                <table class="table table-responsive">
                    @if ($in == 0)
                    <tr>
                        <p> {{ date("d-m-Y", strtotime($practica->data_entrega)) }} </p>
                        <h5>{{ $practica->titol }}</h5>
                    </tr>
                    @endif
                    @foreach ($tasques as $tasca)
                    @if ($practica->id == $tasca->practica_id)
                    <tr>
                        @if ($tasca->grup_id)
                        @foreach ($grups as $grup)
                        @if ($grup->id == $tasca->grup_id)
                        <td>
                            <p> Grup: {{ $grup->nom }} </p>
                        </td>
                        <td>
                            <a href="{{ route('avaluar', ['id' => $tasca->id]) }}" class="btn btn-sm btn-info">Avaluar</a>
                        </td>
                        @endif
                        @endforeach
                        @endif
                    <tr>
                        @endif
                        @endforeach
                </table>
            </div>

            @endforeach
        </div>
    </div>
</div>
@endsection