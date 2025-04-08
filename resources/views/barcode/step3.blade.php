@extends('main')

@section('content')

<form method="POST" action="/barcode/step4">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Carregar exemplares com prefixo da localização</h5>
    <div class="card-body">

        <div class="form-group">

            @foreach($instances as $instance)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="{{ $instance->id }}" id="{{ $instance->id }}" name="instances[]" checked>
                    <label class="form-check-label" for="{{ $instance->id }}">
                        Exemplar: {{ $instance->exemplar}}, Tombo: {{ $instance->tombo }} - {{ $instance->livro->titulo }}
                    </label>
                </div>
            @endforeach

            <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Gerar Etiquetas</button> 
                </div> 
            </div>

        </div>

    </div>
</div>
</form>
@endsection('content')
