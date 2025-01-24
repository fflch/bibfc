@extends('main')

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">

      <a class="btn btn-outline-success btn-md" href="/livros/{{$livro->id}}/edit">Editar</a> 

      <form method="POST" action="/livros/{{ $livro->id }}" style="display:inline">
          @csrf 
          @method('delete')
          <button type="submit" class="delete-item btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Deletar</button>
      </form>

      <br><br>
      <div class="row">

        <div class="col-md text-break"><h6 class="font-weight-bold">Título</h6>
          <b>{{ $livro->titulo }}</b><br/>
          {{ $livro->subtitulo }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Assuntos</h6>
            <ul>
                @forelse($livro->assuntos as $assunto)
                    <li>{{ $assunto->titulo }}

                    <form method="POST" action="/livro_assuntos/{{ $assunto->pivot->id }}" style="display:inline">
                      @csrf
                      @method('delete')
                      <button type="submit" class="delete-item btn"><i class="fas fa-trash-alt"
                        onclick="return confirm('Você tem certeza que deseja apagar?')"
                      ></i></button>
                    </form>

                    </li>
                @empty
                    <li>Não há assuntos cadastrados</li>
                @endforelse
                <li><a href="/livro_assuntos/{{ $livro->id }}"> <i class="fas fa-plus"></i> Adicionar Assunto</a></li>
              </ul>
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Autor</h6>
            <ul>
                @forelse($livro->responsabilidades as $responsabilidade)
                    <li>{{ $responsabilidade->nome }} {{ $responsabilidade->sobrenome }} ({{ $responsabilidade->pivot->tipo }})

                    <form method="POST" action="/livro_responsabilidades/{{ $responsabilidade->pivot->id }}" style="display:inline">
                      @csrf
                      @method('delete')
                      <button type="submit" class="delete-item btn"><i class="fas fa-trash-alt"
                        onclick="return confirm('Você tem certeza que deseja apagar?')"
                      ></i></button>
                    </form>

                    </li>
                @empty
                    <li>Não há Autor cadastrado</li>
                @endforelse
                <li><a href="/livro_responsabilidades/{{ $livro->id }}"> <i class="fas fa-plus"></i> Adicionar Autor</a></li>
              </ul>
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Exemplares</h6>
            <ul>
                @forelse($livro->instances as $instance)
                    <li>
                      
                        <a href="/instances/{{ $instance->id }}">
                            {{ $instance->tombo }} ({{ $instance->tombo_tipo }})
                        </a>
                        <a href="/instances/{{ $instance->id }}/edit?livro_id={{$livro->id}}"><i class="fas fa-pencil-alt"></i></a>
                        
                        <form method="POST" action="/instances/{{ $instance->id }}" style="display:inline">
                          @csrf
                          @method('delete')
                          <button type="submit" class="delete-item btn"><i class="fas fa-trash-alt"
                            onclick="return confirm('Você tem certeza que deseja apagar?')"
                          ></i></button>
                        </form>
                        
                    </li>
                @empty
                    <li>Não há exemplares cadastrados</li>
                @endforelse
                <li><a href="/instances/create?livro_id={{$livro->id}}"> <i class="fas fa-plus"></i> Adicionar Exemplar </a></li>
            </ul>
        </div>

      </div>

      <hr>

      <div class="row">

        <div class="col-md  text-break"><h6 class="font-weight-bold">Localização:</h6>
          {{ $livro->localizacao_formatada ?? 'N/A' }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Colorido:</h6>
          {{ $livro->colorido }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Ilustrado:</h6>
          {{ $livro->ilustrado ?? 'N/A' }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">ISBN:</h6>
          {{ $livro->isbn ?? 'N/A' }}
        </div>


        <div class="col-md  text-break"><h6 class="font-weight-bold">Dimensão:</h6>
          {{ $livro->dimensao ?? 'N/A' }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Extensão:</h6>
          {{ $livro->extensao ?? 'N/A' }}
        </div>

        <div class="col-md text-break"><h6 class="font-weight-bold">Nº de Páginas</h6>
          {{ $livro->paginas }}
        </div>

      </div>

      <hr>
      
      <div class="row">

        <div class="col-md  text-break"><h6 class="font-weight-bold">Volume</h6>
          {{ $livro->volume ?? 'N/A' }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Editora</h6>
          {{ $livro->editora ?? 'N/A' }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Local</h6>
          {{ $livro->local ?? 'N/A' }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Ano</h6>
          {{ $livro->ano }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Edição</h6>
          {{ $livro->edicao ?? 'N/A' }}
        </div>
        
        <div class="col-md text-break"><h6 class="font-weight-bold">Idioma</h6>
        {{ $livro->idioma ?? 'N/A'}}
        </div>
      </div>


    </div>
 </div>
</div>

</br>

@endsection('content')

