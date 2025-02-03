@extends('main')

@section('content')

<form method="POST" action="/barcode/emprestar">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Emprestar</h5>
    <div class="card-body">

        <div class="form-group">

            <div class="form-row">
                <div class="form-group col-md font-weight-bold">
                    <label for="usuario">Matrícula do Adolescente</label>
                    <input type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md font-weight-bold">
                    <label for="barcode">Tombo do Livro</label>
                    <input type="text" class="form-control" name="barcode" value="{{ old('barcode') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Emprestar</button> 
                </div> 
            </div>

        </div>

    </div>
</div>
</form>
@endsection('content')