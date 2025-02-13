@extends('main')

@section('content')


    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/responsabilidades/create" class="btn btn-success">Novo autor</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><b>Pesquisar autores</b></div>
        <div class="card-body">
            <form method="GET" action="/responsabilidades">
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
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Morte</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($responsabilidades as $responsabilidade)
            <tr>
                <td><a href="/responsabilidades/{{$responsabilidade->id}}">
                    {{ \App\Models\Responsabilidade::nomeAutor($responsabilidade->nome) }}
                    </a>
                </td>
                <td>{{ $responsabilidade->ano_nascimento }}</td>
                <td>{{ $responsabilidade->ano_falecimento }}</td>
                <td>    
                    <a href="/responsabilidades/{{$responsabilidade->id}}/edit" ><i class="fas fa-pencil-alt"></i></a> 
                    <form method="POST" action="/responsabilidades/{{ $responsabilidade->id }}" style="display:inline">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="delete-item btn" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $responsabilidades->appends(request()->query())->links() }}

@endsection('content')
