<table class="table table-striped" id="livros">
    <thead>
        <tr>
            <th scope="col">Título</th>
            <th scope="col">Autor</th>
            <th scope="col">Localização</th>
            <th scope="col">Exemplares</th>
            <th scope="col">Assuntos</th>
            <th scope="col">Notas</th>
            <th scope="col">Status</th>
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
                                {{ $instance->tombo }} - {{ $instance->exemplar }} ({{$instance->unidade->nome_unidade}}) 
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

<script>
$('#livros').DataTable( {
    dom: 'fBitp', // https://datatables.net/examples/basic_init/dom.html
    select: true,
    "paging": false,
    "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_pt.json"
    },
    'info': ''
    
} );
</script>
