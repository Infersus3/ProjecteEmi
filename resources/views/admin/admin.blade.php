@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Professors</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                    <table class="table table-responsive">
                <tr>
                <td>
                    <h5 class="users">Joan Sànchez </h5>
                </td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#!">Alumne</a>
                        <a class="dropdown-item" href="#!">Professor</a>
                    </div>
                </td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-danger btn-secondary" > Eliminar </button>
                </td>
                </tr>
                    <tr>
                <td>
                    <h5 class="users">Pau Peres </h5>
                    </td>
                    <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#!">Alumne</a>
                        <a class="dropdown-item" href="#!">Professor</a>
                    </div>
                    </td>
                    <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-danger btn-secondary" > Eliminar </button>
                </td>
                    </tr>
                </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Alumnes</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                    <table class="table table-responsive">
                <tr>
                <td>
                    <h5 class="users">Joan Sànchez </h5>
                </td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#!">Alumne</a>
                        <a class="dropdown-item" href="#!">Professor</a>
                    </div>
                </td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-danger btn-secondary" > Eliminar </button>
                </td>
                </tr>
                    <tr>
                <td>
                    <h5 class="users">Pau Peres </h5>
                    </td>
                    <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#!">Alumne</a>
                        <a class="dropdown-item" href="#!">Professor</a>
                    </div>
                    </td>
                    <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-danger btn-secondary" > Eliminar </button>
                </td>
                    </tr>
                </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Usuaris</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                    <table class="table table-responsive">
                <tr>
                <td>
                    <h5 class="users">Joan Sànchez </h5>
                </td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#!">Alumne</a>
                        <a class="dropdown-item" href="#!">Professor</a>
                    </div>
                </td>
                <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-danger btn-secondary" > Eliminar </button>
                </td>
                </tr>
                    <tr>
                <td>
                    <h5 class="users">Pau Peres </h5>
                    </td>
                    <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#!">Alumne</a>
                        <a class="dropdown-item" href="#!">Professor</a>
                    </div>
                    </td>
                    <td>
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-danger btn-secondary" > Eliminar </button>
                </td>
                    </tr>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
