@extends('main')

@section('content')

<form method="POST" action="/barcode/tombo">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Carregar exemplares com prefixo da localização</h5>
    <div class="card-body">


        <div class="row">
            <div class="col-sm form-group">
                <label for="tombos">Tombos</label>
                <textarea class="form-control" id="tombos" rows="5" name="tombos">{{old('tombos')}}</textarea>
                <small>Inserir tombos separados por vírgula, exemplo: 1022,3211,2333</small>
            </div>
        </div>

        <div class="row">
            <div class="col-sm form-group">
                <button type="submit" class="btn btn-success">Gerar etiquetas</button> 
            </div> 
        </div>

    </div>
</div>
</form>
@endsection('content')
