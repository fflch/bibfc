@extends('main')

@section('content')
    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/usuarios/create" class="btn btn-success">Nova usuario</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><b>usuarios dos itens de empréstimo</b></div>
        <div class="card-body">
            <form method="GET" action="/usuarios">
                <div class="row form-group">
                    <div class="col-sm" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o nome da usuario">
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
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td><a href="/usuarios/{{$usuario->id}}">{{ $usuario->nome }}</a></td>
                <td>
                    <a href="/usuarios/{{$usuario->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="/usuarios/{{ $usuario->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $usuarios->appends(request()->query())->links() }}
@endsection('content')
