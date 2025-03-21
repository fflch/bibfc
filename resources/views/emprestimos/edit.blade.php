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
                <b>Título:</b> {{ $emprestimo->instance->livro->titulo }} 
                
                <br>
                <b>Tombo:</b> {{ $emprestimo->instance->tombo }} ({{ $emprestimo->instance->exemplar }})

                </br>
                <b>Usuário:</b> {{ $emprestimo->usuario->matricula }} - {{ $emprestimo->usuario->nome }}
            </div>

            <div class="col-sm">
                @if($emprestimo->usuario->tem_foto())
                    <img src="/foto/{{ $emprestimo->usuario->matricula }}" width="150px">
                @else 
                    <i class="fas fa-user-tie fa-5x"></i>
                @endif
            </div>

        </div>

        <div class="form-group">
            <label for="obs">Observações</label>
            <textarea class="form-control" name="obs" rows="3">{{ old('obs', $emprestimo->obs) }}</textarea>
        </div>


        <button class="btn btn-outline-success" type="submit">Confirmar Devolução de Material</button>
    </div>
</div>
</form>
@endsection('content')