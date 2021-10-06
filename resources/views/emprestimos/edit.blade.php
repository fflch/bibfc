@extends('main')

@section('content')

<form method="POST" action="/emprestimos/{{$emprestimo->id}}">
@csrf
@method('patch')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Devolução de Empréstimo</h5>
    <div class="card-body">

        <div class="form-row">
            <div class="col-sm">
                <h6 class="font-weight-bold">Título: {{ $emprestimo->livro->titulo }}</h6>
                <h6 class="font-weight-bold">Exemplar: {{ $emprestimo->livro->tombo }}</h6>
                </br>
                <h6 class="font-weight-bold">Usuário: {{ $emprestimo->usuario->matricula }} - {{ $emprestimo->usuario->nome }}</h6>
            </div>

            <div class="col-sm">
                @if($emprestimo->usuario->tem_foto())
                    <img src="/foto/{{ $emprestimo->usuario->matricula }}" width="150px">
                @else 
                    <i class="fas fa-user-tie fa-5x"></i>
                @endif
            </div>

        </div>


        <button class="btn btn-outline-success" type="submit">Confirmar Devolução de Material</button>
    </div>
</div>
</form>
@endsection('content')