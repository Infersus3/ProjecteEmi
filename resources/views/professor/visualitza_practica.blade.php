@extends('layouts.app')

@section('content')
<div class="container">


    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Alumnes</h5>
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
                            <a href="" class="btn btn-sm btn-danger btn-secondary" value=""> Eliminar </a>
                        </td>
                        </tr>
                        @endfor
                </table>
            </div>
        </div>
    </div>
</div>

@endsection