@extends('main')

@section('content')

    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/tccs/create" class="btn btn-success">Novo TCC</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><b></b></div>
        <div class="card-body">
            <form method="GET" action="/tccs">
            <div class="row form-group">
                <div class="col-sm">
                    <input type="text" class="form-control" name="titulo" value="{{ Request()->titulo }}" placeholder="Título">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" name="autores" value="{{ Request()->autores }}" placeholder="Autores">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" name="orientador" value="{{ Request()->orientador }}" placeholder="Orientador">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" name="localizacao" value="{{ Request()->localizacao }}" placeholder="Localização">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" name="ano" value="{{ Request()->ano }}" placeholder="Ano">
                </div>
                <div class=" col-auto">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autores</th>
            <th>Localização</th>
            <th>Orientador</th>
            <th>Ano</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tccs as $tcc)
        <tr>

            <td><a href="/tccs/{{$tcc->id}}">{{ $tcc->titulo }}</a></td>

            <td>{{ $tcc->autores }}</td>
            <td>{{ $tcc->localizacao }}</td>
            <td>{{ $tcc->orientador }}</td>
            <td>{{ $tcc->ano }}</td>

        </tr>
    @endforeach
    </tbody>
</table>


    {{ $tccs->appends(request()->query())->links() }}

@endsection('content')
