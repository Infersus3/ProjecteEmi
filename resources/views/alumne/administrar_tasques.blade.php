@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pràctiques</h5> 
        </div>
        <div class="card-body">
            <div class="card-body">
                <table class="table table-responsive">
                    @foreach ($tasques as $tasca) <tr>
                        <td>
                            @foreach ($practiques as $practica)
                            @if ($practica->id == $tasca->practica_id)
                                <h5 class="users">{{ $practica->titol }}</h5>
                            @endif
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('realitza_tasca', ['id' => $tasca->id]) }}" class="btn btn-sm btn-info">Fer practica</a>
                        </td>
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
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection