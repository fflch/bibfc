@extends('main')

@section('content')

<form method="POST" action="/confirm/{{ $usuario->id }}/{{ $livro->id }}">
@csrf


<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Confirmação de Empréstimo ou Renovação</h5>
    <div class="card-body">

        <i>O usuário <b>{{ $usuario->nome }}</b> está com os seguintes 
        livros emprestados, deseja continuar?</i> <br><br>

        @include('usuarios.partials.emprestimos')

        <div class="form-group">
            <label for="obs">Observações sobre este empréstimo</label>
            <textarea class="form-control" name="obs" rows="3">{{ old('obs') }}</textarea>
        </div>
        
        <div class="col-sm form-group">
            <button type="submit" class="btn btn-success">Confirmar Empréstimo ou Renovação</button>
            <a href="/emprestimos" class="btn btn-danger">Cancelar</a>
        </div>
    </div>
</div>
</form>


@endsection('content')