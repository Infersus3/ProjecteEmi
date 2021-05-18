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
                    </tr>
                    @foreach ($tasques as $tasca) 
                    @if ($practica->id == $tasca->practica_id)
                    <tr>
                        <td>
                                <h5 class="users">{{ $practica->titol }}</h5>
                        </td>
                        <td>
                        @if ($practica->data_entrega >= $data)
                            <a href="{{ route('realitza_tasca', ['id' => $tasca->id]) }}" class="btn btn-sm btn-info">Fer practica</a>
                        @else
                        <a href="{{ route('realitza_tasca', ['id' => $tasca->id]) }}" class="btn btn-sm btn-warning">Veure practica</a>
                            @endif
                        </td>
                        @if ($tasca->nota)
                            @if ($tasca->nota > 5)
                            <td>
                                <button class="btn btn-sm btn-success">{{ $tasca->nota }}</button>
                            </td>
                            @elseif ($tasca->nota < 4)
                            <td>
                                <button class="btn btn-sm btn-danger">{{ $tasca->nota }}</button>
                            </td>
                            @else
                            <td>
                                <button class="btn btn-sm btn-warning">{{ $tasca->nota }}</button>
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
            </div>
            
            @endforeach
        </div>
    </div>
</div>
@endsection