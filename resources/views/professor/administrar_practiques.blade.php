@section
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
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown"> Edit </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="{{ route('add_alumne', ['id' => $professor->id]) }}">Alumne</a>
                    </div>
                </td>
                <td>
                    <a href="{{ route('delete_users', ['id' => $professor->id]) }}" class="btn btn-sm btn-danger btn-secondary" value="{{ $professor->name }}"> Eliminar </button>
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