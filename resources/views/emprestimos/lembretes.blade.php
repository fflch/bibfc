@extends('main')

@section('content')

@forelse($emprestimos as $emprestimo)

    @if($emprestimo->atrasado)

        Olá, <b>{{ $emprestimo->usuario->nome }}</b>.
        <br>
        Estamos enviando este bilhete para lembrá-la de devolver os livros retirados na biblioteca da escola.

        Aqui na nossa lista mostra que você está com o seguinte livro: 
        <b>{{ $emprestimo->instance->livro->titulo }},</b>
        de
        @foreach($emprestimo->instance->livro->responsabilidades as $responsabilidade)
        {{ $responsabilidade->nome }}.
        @break
        @endforeach

        <br>
        Retirado em: <b>{{ $emprestimo->data_emprestimo }}.</b><br>
        Com prazo de devolução para: {{ $emprestimo->prazo }}

        <br><br><br>
    @endif
@empty
    Não não livros atrasados
@endforelse

@endsection('content')