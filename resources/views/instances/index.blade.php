@extends('main')

@section('content')

<h1>Extraviados</h1>
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Status</th>
            <th>Tombo</th>
            <th>Título</th>
            <th>Autor</th>
            <th>Localização</th>
            <th>Notas</th>
            <th>Possui Empréstimos?</th>
        </tr>
    </thead>
    <tbody>
    @foreach($instances as $instance)
        <tr>
            <td>{{ $instance->status }}</td>
            <td><a href="/instances/{{ $instance->id }}">{{ $instance->tombo }} ({{ $instance->tombo_tipo }})</a></td>

            <td><a href="/livros/{{$instance->livro->id}}">{{ $instance->livro->titulo }}</a></td>

            <td>
                <ul>
                @forelse($instance->livro->responsabilidades as $responsabilidade)
                    <li>{{ $responsabilidade->nome }} ({{ $responsabilidade->pivot->tipo }})</li>
                @empty
                    <li>Não há Autor cadastrado</li>
                @endforelse
                </ul>
            </td>

            <td><a href="/livros/{{$instance->livro->id}}">{{ $instance->livro->localizacao_formatada }}</a></td>

            <td>{{ $instance->notas }}</td>

            <td>
                @if(\App\Models\Emprestimo::where('instance_id',$instance->id)->whereNull('data_devolucao')->first())
                    <a href="/emprestimos/{{\App\Models\Emprestimo::where('instance_id',$instance->id)->whereNull('data_devolucao')->first()->id}}">Sim</a>
                @else 
                    Não
                @endif

            </td>

        </tr>
    @endforeach
    </tbody>
</table>



@endsection('content')
