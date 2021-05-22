@extends('layouts.app')

@section('content')
<div class="container">

    <form action="{{ route('crear_grup') }}" class="create_grup">
        <div class="card-pers">
            <div class="card-header">
                <h4> Crear Grup </h4>
            </div>
            <div class="grup-input">
                <input type="text" name="nom" class="form-control input-grup" required placeholder="Nom del grup">
                <input type="submit" class="btn btn-secondary" value="Crear Grup">
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-8">
            <div class="row">
                @foreach ($grups as $grup)
                <div class="col-md-5 grups_table">
                    <div class="card sm-card">
                        <div class="card-header">
                            <h4 class="titol_grups">{{$grup->nom}}</h4>
                            <a href="{{ route('eliminar_grup', ['id' => $grup->id]) }}" value="{{ $grup->nom }}" class="btn btn-sm btn-danger delGrup"><i class="fas fa-trash-alt"></i> Eliminar </a> </h3>
                        </div>
                        <div class="card-body">
                            @foreach ($grup->alumnes as $alumne)
                            <table class="table table-responsive">
                                <tr>
                                    <td>
                                        <div class="btn">
                                            <h5 class="users">{{ $alumne->nom }} </h5>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('delete_alumne_grup', ['idAlumne' => $alumne->id, 'idGrup' => $grup->id]) }}" class="btn btn-sm btn-danger delAlumnes" value="{{ $alumne->nom }}" value2="{{$grup->nom}}"><i class="fas fa-trash-alt"></i> Eliminar</a>
                                    </td>
                                </tr>
                            </table>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-4 grup-alumnes">
            <div class="card sm-card">
                <div class="card-header">
                    <h4>Alumnes</h4>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        @foreach ($alumnes as $alumne)
                        <tr>
                            <td>
                                <div class="btn">
                                    <h5 class="users">{{ $alumne->nom }}</h5>
                                </div>
                            </td>
                            <td>
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Assignar </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <!-- Mostrem els grups on el alumne no pertany solament -->
                                    <!-- Si el alumne està en un grup determinat posem la variable 'in' com a 1, així no mostrem el nom del grup-->
                                    @if (count($alumne->grups))
                                    @foreach ($grups as $grup)
                                    @php $in = 0;
                                    foreach ($alumne->grups as $alumneGrup){
                                    if ($alumneGrup->id == $grup->id){
                                    $in = 1;
                                    }else{}
                                    } @endphp
                                    @if ($in == 0)
                                    <a class="dropdown-item" href="{{ route('add_alumne_grup', ['idGrup' => $grup->id, 'idAlumne' => $alumne->id]) }}">{{$grup->nom}}</a>
                                    @endif
                                    @endforeach
                                    @else
                                    @foreach ($grups as $grup)
                                    <a class="dropdown-item" href="{{ route('add_alumne_grup', ['idGrup' => $grup->id, 'idAlumne' => $alumne->id]) }}">{{$grup->nom}}</a>
                                    @endforeach
                                    @endif
                                </div>
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
    $(function() {
        $('.delAlumnes').on('click', function() {
            let alumne = $(this).attr('value');
            let grup = $(this).attr('value2');
            return window.confirm('Segur que vols esborrar l\'usuari: \'' + alumne + '\' del grup \'' + grup + '\' ?');
        });

        $('.delGrup').on('click', function() {
            let grup = $(this).attr('value');
            return window.confirm('Si borres el grup: ' + grup + ', s\'eliminaran les activitats asociades a ell' +
                ' segur que vols esborrar-lo?');
        });
    })
</script>
@endsection