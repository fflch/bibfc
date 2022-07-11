@extends('main')

@section('content')


    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/assuntos/create" class="btn btn-success">Novo assunto</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><b></b></div>
        <div class="card-body">
            <form method="GET" action="/assuntos">
                <div class="row form-group">
                    <div class="col-sm" id="search">
                        <input type="text" class="form-control" name="search" value="{{ Request()->search }}" placeholder="Busca...">
                    </div>
                    <div class=" col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <ul>
        @each('assuntos.partials.assunto', $assuntos, 'assunto')
    </ul>

@endsection('content')
