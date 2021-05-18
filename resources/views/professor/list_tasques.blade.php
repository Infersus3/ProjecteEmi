@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pràctiques</h5>
        </div>
        <div class="card-body">
            @foreach ($practiques as $practica)

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
                        <td>
                            <h5>Alumne: {{ $alumne->nom }}</h5>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Avaluar</a>
                        </td>
                        @endif
                        @endforeach
                        @endif
                    <tr>
                        @endif
                        @endforeach
                </table>
                <table class="table table-responsive">
                    <tr>
                        <p> {{ date("d-m-Y", strtotime($practica->data_entrega)) }} </p>
                        <h5>{{ $practica->titol }}</h5>
                    </tr>
                    @foreach ($tasques as $tasca)
                    @if ($practica->id == $tasca->practica_id)
                    <tr>
                        @if ($tasca->grup_id)
                        @foreach ($grups as $grup)
                        @if ($grup->id == $tasca->grup_id)
                        <td>
                            <h5> Grup: {{ $grup->nom }} </h5>
                        </td>
                        <td>
                            <a href="#" class="btn btn-sm btn-info">Avaluar</a>
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