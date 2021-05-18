@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Compostos Químics &nbsp; <a href="{{ route('crear_compost') }}" class="btn btn-sm btn-info"> Crear Compost</a></h5>
        </div>
        <div class="card-body">
            <div class="card-body">
                <table class="table table-responsive">
                    @foreach ($compost as $c)
                    <tr>
                    <td>
                        <h5 class="users">{{ $c->nom }}</h5>
                    </td>
                    @php $in = 0;
                    foreach ($mcc as $mosCondComp){
                            if ($c->id == $mosCondComp->compost_quimic_id){
                                $in = 1;
                            }
                    }
                    @endphp
                    <td>
                    @if ($in)
                        <a class="btn btn-sm btn-warning">Compost Químic en ús</a>
                    @else
                        <a href="{{ route('delete_compost', ['id' => $c->id]) }}" class="btn btn-sm btn-danger">Eliminar</a>
                    @endif
                    </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection