@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Practica noseque</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-responsive">
                            @foreach ($tasques as $tasca)
                            @if ($tasca->alumne_id != null)
                            @foreach ($alumnes as $alumne)
                            @if ($alumne->id == $tasca->alumne_id)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $alumne->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
                        </table>
                        <table class="table table-responsive">
                            @foreach ($tasques as $tasca)
                            @if ($tasca->grup_id != null)
                            @foreach ($grups as $grup)
                            @if ($grup->id == $tasca->grup_id)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $grup->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $grup->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                            @endforeach
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
                            @if (count($tasques))
                            @foreach ($tasques as $tasca)
                            @if ($tasca->alumne_id != null)
                            @foreach ($alumnes as $alumne)
                            @if ($alumne->id != $tasca->alumne_id)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $alumne->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @else
                            @foreach ($alumnes as $alumne)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $alumne->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            @foreach ($alumnes as $alumne)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $alumne->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grups</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-responsive">
                            @if (count($tasques))
                            @foreach ($tasques as $tasca)
                            @if ($tasca->grup_id != null)
                            @foreach ($grups as $grup)
                            @if ($grup->id != $tasca->grup_id)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $grup->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $grup->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @else
                            @foreach ($grups as $grup)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $grup->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $grup->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            @endforeach
                            @else
                            @foreach ($grups as $grup)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $grup->nom }}</h5>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item">Professor</a>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger btn-secondary" value="{{ $grup->nom }}"> Eliminar </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif

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
    $(function() {
        $('.btn-danger').on('click', function() {
            let name = $(this).attr('value');
            return window.confirm('Segur que vols esborrar l\'usuari' + ' ' + name);
        });
    })
</script>
@endsection