@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container-fluid">
                <!-- MISSATGES I ERRORS* -->
                @if ($errors->any())
                @foreach ($errors->all() as $message)
                <div class="d-flex align-items-center justify-content-center text-center">
                    <div class="col-lg-12 alert alert-danger">
                        <p> {{ $message }} </p>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="card-form">
                <div class="card-header">
                    <h4>Creació Compost Químic</h4>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <form id="myform" action="{{ route ('crear_compost') }}">
                                    <div class="form-group">
                                        <label for="labelNom">Nom del compost</label>
                                        <input type="text" name="nom_compost" class="form-control" id="labelNom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="labelFormula">Formula</label>
                                        <input type="text" name="formula" class="form-control" id="labelFormula" required>
                                    </div>
                            </div>
                        </div>
                        <a href="{{ route('admin_compost')}}" class="btn btn-secondary">Cancelar</a>
                        <input type="submit" name="submit" class="btn btn-dark" value="Envia"></input>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
