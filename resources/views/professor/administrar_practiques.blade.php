@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Pràctiques</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                    <table class="table table-responsive">
                @foreach ($practiques as $practica)
                <tr>
                <td>
                    <h5 class="users">{{ $practica->nom}}</h5>
                </td>
                <td>
                <a href="#" class="btn btn-sm btn-primary btn-secondary"> Editar </a>
                </td>
                <td>
                <a href="#" class="btn btn-sm btn-danger btn-secondary"> Eliminar </a>
                </td>
                </tr>
                @endforeach
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function(){
    $('.btn-danger').on('click', function(){
    let name = $(this).attr('value');
   return window.confirm('Segur que vols esborrar l\'usuari'+' '+name);
    });
})
</script>
@endsection