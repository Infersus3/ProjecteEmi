@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Pràctiques &nbsp; <a href="{{ route('crear_practica') }}" class="btn btn-sm btn-info"> Crear Pràctica</a> <a href="{{ route('admin_compost') }}" class="btn btn-sm btn-info"> Administrar CQ</a> </h5> 
        </div>
        <div class="card-body">
            <div class="card-body">
                <table class="table table-responsive">
                    @for ($i = 0; $i < count($practica); $i++) <tr>
                        <td>
                            <h5 class="users">Practica {{ $i+1 }}</h5>
                        </td>
                        <td>
                            <a href="{{ route('edita_practica', ['id' => $practica[$i]->id]) }}" class="btn btn-sm btn-info">Editar</a>
                        </td>
                        <td>
                            <a href="{{ route('admin_tasques', ['id' => $practica[$i]->id]) }}" class="btn btn-sm btn-success">Asignar</a>
                        </td>
                        <td>
                            <a href="{{ route('elimina_practica', ['id' => $practica[$i]->id]) }}" class="btn btn-sm btn-danger btn-secondary" value="{{ $practica[$i]->titol }}"> Eliminar </a>
                        </td>
                        </tr>
                        @endfor
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
    let titol = $(this).attr('value');
   return window.confirm('Segur que vols esborrar la pràctica: '+titol);
    });
})
</script>
@endsection