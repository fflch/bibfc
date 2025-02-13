<div class="col" style="margin-bottom:5px;">
    <form method="post" action="/pre/aprovar_todos">
        @method("put")
        @csrf
        <button class="btn btn-success" name="status" value="1">Aprovar todos os registros</button>
    </form>
</div>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Localização</th>
            <th>Exemplares</th>
            <th>Assuntos</th>
            <th>Notas</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($livros as $livro)
        <tr>
            <td><a href="/livros/{{$livro->id}}"><b>{{ $livro->titulo }}</b>{{$livro->subtitulo ? ": " . $livro->subtitulo : ''}}</a></td>
            <td>
                <ul>
                @forelse($livro->responsabilidades as $responsabilidade)
                    <li>{{\App\Models\Responsabilidade::nomeAutor($responsabilidade->nome)}} ({{ $responsabilidade->pivot->tipo }})
                    </li>

                @empty
                    <p class="text-danger">Não há autor cadastrado</p>
                @endforelse
                </ul>
            </td>

            <td><a href="/livros/{{$livro->id}}">{{ $livro->localizacao_formatada }}</a></td>

            <td>
                <ul>
                    @forelse($livro->instances as $instance)
                        <li><a href="/instances/{{ $instance->id }}">
                                {{ $instance->tombo }} - {{ $instance->tombo_tipo }} ({{$instance->unidade->nome_unidade}}) 
                            </a> ({{ $instance->status }})
                        </li>
                    @empty
                        <li>Não há exemplares cadastrados</li>
                    @endforelse
                </ul>
            </td>

            <td>
                <ul>
                @forelse($livro->assuntos as $assunto)
                    <li>{{ $assunto->titulo }}</li>
                @empty
                    <li>Não há assuntos cadastrados</li>
                @endforelse
                </ul>
            </td>

            <td>{{ $livro->obs }}</td>
            <td>
                @if($livro->status === NULL && !$livro->instances->toArray())
                <div class="row">
                    <div class="col-g">
                        <form method="post" action="/pre/{{$livro->id}}">
                            @csrf
                            <button class="btn btn-success" name="status" value="1">Aprovar</button>
                        </form>
                    </div>
                    <div class="col">
                        <form method="post" action="/pre/{{$livro->id}}">
                            @csrf
                            <button class="btn btn-danger" name="status" value="0">Reprovar</button>
                        </form>
                    </div>
                </div>
                @else
                    @if($livro->status == 1)
                        <p class="text-success">Aprovado</p>
                    @elseif($livro->status === NULL)
                        <p class="text-info">Status não cadastrado</p>
                    @else
                        <p class="text-danger">Reprovado</p>
                    @endif  
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
