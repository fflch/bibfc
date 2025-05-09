@extends('main')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm">
                <br>
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
    
    @if($usuario->tem_foto())
        <img src="/foto/{{ $usuario->matricula }}" width="150px">
    @else 
        <i class="fas fa-user-tie fa-5x"></i>
        <p>{{$usuario->unidade->nome_unidade}} - {{$usuario->unidade->localizacao_unidade}}</p>
    @endif
<div class="card">
    <div class="card-body">
        <div class="flex" style="display:grid;">
            <li style="display:inline-block;"><b>Nome: </b>{{ $usuario->nome }}</li></li>
            <li style="display:inline-block;"><b>Matrícula: </b>{{ $usuario->matricula }}</li>
            <li style="display:inline-block;"><b>Observação: </b>{{ $usuario->obs }}</li>
            <li style="display:inline-block;"><b>Prontuário: </b>{{ $usuario->prontuario }}</li>
            <li style="display:inline-block;"><b>Sala de aula: </b>{{ $usuario->sala_de_aula }}</li>
            <li style="display:inline-block;"><b>Quarto: </b>{{ $usuario->quarto }}</li>
            <li style="display:inline-block;"><b>Unidade: </b>{{ $usuario->unidade->nome_unidade }}</li>
            <li style="display:inline-block;"><b>Status</b>: {{$usuario->status == true ? 'Ativo' : 'Inativo'}}</li>
        </div>
    </div>
</div>

@include('usuarios.partials.emprestimos',[
    'emprestimos' => $usuario->emprestimos
]) 

@endsection('content')
