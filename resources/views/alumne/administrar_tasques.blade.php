@extends('layouts.app')

@section('content')
<div class="wrapper-sm">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pràctiques</h5>
        </div>
        <div class="card-body">
            @foreach ($practiques as $practica)

            <table class="table table-responsive">
                @php $in = 0;
                foreach ($tasques as $tasca){
                if ($practica->id == $tasca->practica_id){
                $in = 1;
                }
                }
                @endphp
                @if ($in)
                <tr>
                    <p> {{ date("d-m-Y", strtotime($practica->data_entrega)) }} </p>
                </tr>
                @endif
                @foreach ($tasques as $tasca)
                @if ($practica->id == $tasca->practica_id)
                <tr>
                    <td>
                        <div class="btn">
                            <h5 class="users">{{ $practica->titol }}</h5>
                        </div>
                    </td>
                    <td>
                        @if ($practica->data_entrega >= $data)
                        <a href="{{ route('realitza_tasca', ['id' => $tasca->id]) }}" class="btn btn-sm btn-info"><i class="fas fa-pen"></i> Fer practica</a>
                        @else
                        <a href="{{ route('realitza_tasca', ['id' => $tasca->id]) }}" class="btn btn-warning"><i class="fas fa-search"></i> Veure practica</a>
                        @endif
                    </td>
                    @if ($tasca->nota)
                    @if ($tasca->nota > 5)
                    <td>
                        <button class="btn btn-success">Avaluació: {{ $tasca->nota }}</button>
                    </td>
                    @elseif ($tasca->nota < 4) <td>
                        <button class="btn btn-danger">Avaluació: {{ $tasca->nota }}</button>
                        </td>
                        @else
                        <td>
                            <button class="btn btn-warning">Avaluació: {{ $tasca->nota }}</button>
                        </td>
                        @endif
                        @endif
                        @if ($tasca->grup_id)
                        @foreach ($alumne->grups as $grups)
                        @if ($grups->id == $tasca->grup_id)
                        <td>
                            <p> Practica en grup: {{ $grups->nom }} </p>
                        </td>
                        @endif
                        @endforeach
                        @endif
                </tr>
                @endif
                @endforeach
            </table>

            @endforeach
        </div>
    </div>
</div>
@endsection