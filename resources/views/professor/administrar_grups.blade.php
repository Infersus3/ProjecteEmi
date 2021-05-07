@extends('layouts.app')

@section('content')
<div class="wrapper">
    <form action="{{ route('crear_grup') }}">
            <input type="text" name="nom" required placeholder="Nom del grup">
            <input type="submit" class="btn btn-sm btn-primary" value="Crear Grup">
        <form>
    <div class="row ">
        <div class="col-md-8 d-inline-flex">
            @foreach ($grups as $grup)
            <div class="col-md-4 d-inline-flex">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$grup->nom}}</h3>
                        <a href="{{ route('eliminar_grup', ['id' => $grup->id]) }}" value="{{ $grup->nom }}" class="btn btn-sm btn-danger btn-secondary delGrup"> Eliminar </a>
                    </div>
                    <div class="card-body">
                        @foreach ($grup->alumnes as $alumne)
                        <table class="table table-responsive">
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }} </h5>
                                </td>
                                <td>
                                    <a href="{{ route('delete_alumne_grup', ['idAlumne' => $alumne->id, 'idGrup' => $grup->id]) }}" 
                                    class="btn btn-sm btn-danger btn-secondary delAlumnes" value="{{ $alumne->nom }}" value2="{{$grup->nom}}"> Eliminar del grup </a>
                                </td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Alumnes</h5>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-responsive">
                            @foreach ($alumnes as $alumne)
                            <tr>
                                <td>
                                    <h5 class="users">{{ $alumne->nom }}</h5>
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
                                            <a class="dropdown-item" href="{{ route('add_alumne_grup', ['idGrup' => $grup->id, 'idAlumne' => $alumne->id]) }}">{{$grup->nom}}1</a>
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
    $(function(){
    $('.delAlumnes').on('click', function(){
        let alumne = $(this).attr('value');
        let grup = $(this).attr('value2');
        return window.confirm('Segur que vols esborrar l\'usuari: \''+alumne+'\' del grup \''+grup+'\' ?');
    });

    $('.delGrup').on('click', function(){
        let grup = $(this).attr('value');
        return window.confirm('Segur que vols esborrar el grup: '+grup+' ?');
    });
})
</script>
@endsection