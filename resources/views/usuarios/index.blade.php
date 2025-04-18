@extends('main')

@section('content')
    <div class="card">
        <div class="card-header"><b>Buscar adolescente(s)</b></div>
        <div class="card-body">
            <form method="GET" action="/usuarios">
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


<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <label for="export">Exportar dados para Excel</label>
                <form method="get" action="/adolescentes">
                    <button class="btn btn-success"><i class="fas fa-file-export"></i> Exportar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <label for="file">Importar Excel para o sistema</label>
                <form method="post" action="adolescentes/import" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <button type="submit" class="btn btn-success" style="margin-left:10px;"><i class="fas fa-file-import"></i> Importar</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-g">
        <div class="card">
            <div class="card-body">
                <a href="/download" class="btn btn-primary"><i class="fas fa-download"></i> Baixar modelo de planilha</a>
            </div>
        </div>
    </div>
</div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Código de Matrícula</th>
                <th>Nome</th>
                <th>Prontuário</th>
                <th>Sala de Aula</th>
                <th>Quarto</th>
                <th>Observação</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>
                    @if($usuario->tem_foto())
                        <img src="/foto/{{ $usuario->matricula }}" width="120px"><br/>
                        {{$usuario->unidade->nome_unidade}} - {{$usuario->unidade->localizacao_unidade}}
                    @else 
                        <i class="fas fa-user-tie fa-5x"></i><br/>
                        {{$usuario->unidade->nome_unidade}} - {{$usuario->unidade->localizacao_unidade}}
                    @endif
            
                </td>
                <td><a href="/usuarios/{{$usuario->id}}">{{ $usuario->matricula }}</a></td>
                <td><a href="/usuarios/{{$usuario->id}}">{{ $usuario->nome }}</a></td>
                <td>{{ $usuario->prontuario }}</td>
                <td>{{ $usuario->sala_de_aula }}</td>
                <td>{{ $usuario->quarto }}</td>
                <td>{{ $usuario->obs }}</td>
                <td>{{ $usuario->status ? 'Ativo' : 'Inativo' }}</td>

                <td>
                   
                    <a href="/usuarios/{{$usuario->id}}/edit"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" action="/usuarios/{{ $usuario->id }}" style="display:inline">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="delete-item btn" 
                            onclick="return confirm('Você tem certeza que deseja apagar?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $usuarios->appends(request()->query())->links() }}
@endsection('content')
