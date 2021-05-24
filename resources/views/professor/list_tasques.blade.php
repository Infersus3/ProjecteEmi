@extends('layouts.app')

@section('content')
<div class="wrapper-sm">
    <div class="card">
        <div class="card-header">
            <h4>Avaluar pràctiques</h4>
        </div>
        <div class="card-body">
            @foreach ($practiques as $practica)
            @if ($practica->data_entrega < $data) <div class="card-body">
                <table class="table table-responsive">
                    <tr>
                        <p> {{ date("d-m-Y", strtotime($practica->data_entrega)) }} </p>
                        <td class="tr-min">
                            <div class="btn">
                                <h5>{{ $practica->titol }}</h5>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('avaluar_tasques', ['id' => $practica->id]) }}" class="btn btn-info"><i class="fas fa-tasks"></i> Avaluar</a>
                        </td>
                    <tr>
                </table>
        </div>
        @endif
        @endforeach
    </div>
</div>
</div>
@endsection
