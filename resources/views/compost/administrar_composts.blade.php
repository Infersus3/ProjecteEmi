@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Compostos Químics &nbsp; <a href="{{ route('crear_compost') }}" class="btn btn-dark"><i class="fas fa-vial"></i> Crear Compost</a></h4>
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
                        <a class="btn btn-warning">Compost Químic en ús</a>
                    @else
                        <a href="{{ route('delete_compost', ['id' => $c->id]) }}" value="{{ $c->nom }}" class="btn btn-sm btn-danger">Eliminar</a>
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

@section('scripts')
<script>
    $(function(){
    $('.btn-danger').on('click', function(){
    let nom = $(this).attr('value');
    return window.confirm('Segur que vols esborrar el compost: '+nom+'?');
    });
})
</script>
@endsection