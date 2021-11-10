@extends('main')

@section('content')
    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/usuarios/create" class="btn btn-success">Novo usuário</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><b></b></div>
        <div class="card-body">
            <form method="GET" action="/usuarios">
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
                <th>Foto</th>
                <th>Código de Matrícula</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Turma</th>
                <th>Setor</th>
                <th>Observação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>
                    @if($usuario->tem_foto())
                        <img src="/foto/{{ $usuario->matricula }}" width="120px">
                    @else 
                        <i class="fas fa-user-tie fa-5x"></i>
                    @endif
            
                </td>
                <td><a href="/usuarios/{{$usuario->id}}">{{ $usuario->matricula }}</a></td>
                <td><a href="/usuarios/{{$usuario->id}}">{{ $usuario->nome }}</a></td>
                <td>{{ $usuario->telefone }}</td>
                <td>{{ $usuario->turma }}</td>
                <td>{{ $usuario->setor }}</td>
                <td>{{ $usuario->obs }}</td>

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
