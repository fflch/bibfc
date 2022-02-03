@extends('main')

@section('content')

<b>Total</b> de Exemplares:<br>

<ul>
@foreach($totais as $total) 
    <li><b>{{ $total->tombo_tipo }}:</b> {{ $total->num }} </li>
@endforeach
</ul>

    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/livros/create" class="btn btn-success">Novo Livro</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><b></b></div>
        <div class="card-body">
            <form method="GET" action="/livros">
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
                <th>Título</th>
                <th>Responsabilidade</th>
                <th>Localização</th>
                <th>Exemplares</th>
                <th>Notas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($livros as $livro)
            <tr>

                <td><a href="/livros/{{$livro->id}}">{{ $livro->titulo }}</a></td>

                <td>
                    <ul>
                    @forelse($livro->responsabilidades as $responsabilidade)
                        <li>{{ $responsabilidade->nome }} ({{ $responsabilidade->pivot->tipo }})</li>
                    @empty
                        <li>Não há Responsabilidade cadastrada</li>
                    @endforelse
                    </ul>
                </td>

                <td><a href="/livros/{{$livro->id}}">{{ $livro->localizacao_formatada }}</a></td>

                <td>
                    <ul>
                        @forelse($livro->instances as $instance)
                            <li><a href="/instances/{{ $instance->id }}/edit">
                                    {{ $instance->tombo }} ({{ $instance->tombo_tipo }})
                                </a>
                            </li>
                        @empty
                            <li>Não há exemplares cadastrados</li>
                        @endforelse
                    </ul>
                </td>

                <td>{{ $livro->obs }}</td>

                <td>
                    
                    <a href="/livros/{{$livro->id}}/edit" ><i class="fas fa-pencil-alt"></i></a> 

                    <form method="POST" action="/livros/{{ $livro->id }}" style="display:inline">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="delete-item btn" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $livros->appends(request()->query())->links() }}

@endsection('content')
