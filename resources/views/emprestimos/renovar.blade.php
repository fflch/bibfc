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
                <p>Usuário: {{ $emprestimo->usuario->matricula }} - {{ $emprestimo->usuario->nome }}</p>
                <p class="font-weight-bold">Título: {{ $emprestimo->instance->livro->titulo }}</p>
                <p> Renovação de: {{ $emprestimo->instance->tombo }} 
                    ({{ $emprestimo->instance->tombo_tipo }}) - {{ $emprestimo->instance->livro->titulo }}
                </p>
                
                @if($emprestimos->isNotEmpty())
                    <div style="color:red;">Livros já emprestados:</div>
                    <ul style="color:red;">
                        @foreach($emprestimos as $emprestimo)
                        <li>{{ $emprestimo->instance->tombo }} 
                            ({{ $emprestimo->instance->tombo_tipo }}):
                            {{ $emprestimo->instance->livro->titulo }}
                        </li>
                        @endforeach
                    </ul>
                @endif
                
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
            <label for="obs">Observações sobra esta renovação</label>
            <textarea class="form-control" name="obs" rows="3">{{ old('obs', $emprestimo->obs) }}</textarea>
        </div>

        <button class="btn btn-outline-success" type="submit">Confirmar Renovação</button>
    </div>
</div>
</form>
@endsection('content')