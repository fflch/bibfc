@extends('main')

@section('content')

<form method="POST" action="/barcode/step2">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Carregar exemplares com prefixo da localização</h5>
    <div class="card-body">

        <div class="form-group">

            <div class="form-row">
                <div class="form-group col-md font-weight-bold">
                    <label for="localizacao">Localização</label>
                    <input type="text" class="form-control" name="localizacao" value="{{ old('localizacao') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Carregar exemplares</button> 
                </div> 
            </div>

        </div>

    </div>
</div>
</form>
@endsection('content')
