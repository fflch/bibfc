@extends('main')


@section('content')
    <div>
        <div class="row">
            <div class="col-sm">
                <a href="/usuarios/create" class="btn btn-success">Nova Usuário</a><br><br>
            </div>
            <div class="col-auto float-right">
                <a href="/usuarios/{{$usuario->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
            </div>
            <div class="col-auto pull-right">
                <form method="POST" action="/usuarios/{{ $usuario->id }}">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i> Apagar</button>
                </form>
            </div>
        </div>
    </div>
    
    <h2>{{ $usuario->nome }}</h2>
    <div class="card card-header"><b>Materiais</b></div>
    <a href="/usuarios" class="btn btn-primary">Voltar</a>
@endsection('content')
