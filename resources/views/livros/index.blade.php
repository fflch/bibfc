@extends('main')

@section('content')


    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/livros/create" class="btn btn-success">Novo Livro</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><b></b></div>
        <div class="card-body">
            <form method="GET" action="/livros">
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tombo</th>
                <th>Tipo Tombo</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Localização</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($livros as $livro)
            <tr>
                <td><a href="/livros/{{$livro->id}}">{{ $livro->tombo }}</a></td>
                <td>{{ $livro->tombo_tipo }}</td>
                <td>{{ $livro->titulo }}</td>
                <td>{{ $livro->autor }}</td>
                <td>{{ $livro->obs }}</td>
                <td><a href="/livros/{{$livro->id}}">{{ $livro->localizacao }}</a></td>

                <td>
                    <a href="/livros/{{$livro->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="/livros/{{ $livro->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $livros->appends(request()->query())->links() }}

@endsection('content')
