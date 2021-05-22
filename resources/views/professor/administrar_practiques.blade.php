@extends('layouts.app')

@section('content')
<div class="wrapper-sm">
    <div class="card">
        <div class="card-header">
            <h4> Pràctiques </h4>
        </div>
        <div class="card-body">
            <a href="{{ route('crear_practica') }}" class="btn btn-dark"><i class="fas fa-copy"></i> Crear Pràctica</a> <a href="{{ route('admin_compost') }}" class="btn btn-dark"><i class="fas fa-vial"></i> Administrar CQ</a>
            <div class="card-body">
                <table class="table table-responsive">
                    @for ($i = 0; $i < count($practica); $i++) <tr>
                        @if ($practica[$i]->professor_id == Auth::user()->professor_id || Auth::user()->admin)
                        <td>
                            <div class="btn">
                                <h5 class="users"> {{ $practica[$i]->titol }}</h5>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('edita_practica', ['id' => $practica[$i]->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Editar</a>

                        </td>
                        <td>
                            <a href="{{ route('admin_tasques', ['id' => $practica[$i]->id]) }}" class="btn btn-sm btn-success"><i class="fas fa-angle-double-right"></i> Asignar</a>
                        </td>
                        <td>
                            <a href="{{ route('elimina_practica', ['id' => $practica[$i]->id]) }}" class="btn btn-sm btn-danger" value="{{ $practica[$i]->titol }}"><i class="fas fa-trash-alt"></i> Eliminar </a>
                        </td>
                        </tr>
                        @endif
                        @endfor
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {
        $('.btn-danger').on('click', function() {
            let titol = $(this).attr('value');
            return window.confirm('Segur que vols esborrar la pràctica: ' + titol + ', S\'esborraran TOTES les activitats asociades dels alumnes');
        });
    })
</script>
@endsection