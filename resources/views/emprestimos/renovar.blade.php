@extends('main')

@section('content')

<form method="POST" action="/renovar/{{$emprestimo->id}}">
@csrf
@method('post')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Renovação de Empréstimo</h5>
    <div class="card-body">

        <div class="form-row">
            <div class="col-sm">
                <p class="font-weight-bold">Título: {{ $emprestimo->livro->titulo }}</p>
                <p>Exemplar: {{ $emprestimo->livro->tombo }} ({{ $emprestimo->livro->tombo_tipo }})</p>
                
                </br>
                <p>Usuário: {{ $emprestimo->usuario->matricula }} - {{ $emprestimo->usuario->nome }}</p>
            </div>

            <div class="col-sm">
                @if($emprestimo->usuario->tem_foto())
                    <img src="/foto/{{ $emprestimo->usuario->matricula }}" width="150px">
                @else 
                    <i class="fas fa-user-tie fa-5x"></i>
                @endif
            </div>

        </div>

        <button class="btn btn-outline-success" type="submit">Confirmar Renovação</button>
    </div>
</div>
</form>
@endsection('content')