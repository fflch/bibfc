@extends('main')


@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">

      <a class="btn btn-outline-success btn-md" href="/livros/{{$livro->id}}/edit">Editar</a> <br><br>
      
      <div class="row">

        <div class="col-md text-break"><h6 class="font-weight-bold">Título</h6>
          {{ $livro->titulo }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Responsabilidade</h6>
            <ul>
                @forelse($livro->responsabilidades as $responsabilidade)
                    <li>{{ $responsabilidade->nome }} ({{ $responsabilidade->pivot->tipo }})

                    <form method="POST" action="/livro_responsabilidades/{{ $responsabilidade->pivot->id }}" style="display:inline">
                      @csrf
                      @method('delete')
                      <button type="submit" class="delete-item btn"><i class="fas fa-trash-alt"
                        onclick="return confirm('Você tem certeza que deseja apagar?')"
                      ></i></button>
                    </form>

                    </li>
                @empty
                    <li>Não há Responsabilidade cadastrada</li>
                @endforelse
                <li><a href="/livro_responsabilidades/{{ $livro->id }}"> <i class="fas fa-plus"></i> Adicionar Responsabilidade</a></li>
              </ul>
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Exemplares</h6>
            <ul>
                @forelse($livro->instances as $instance)
                    <li>
                        <a href="/instances/{{ $instance->id }}">
                            {{ $instance->tombo }} ({{ $instance->tombo_tipo }})
                        </a>

                        <a href="/instances/{{ $instance->id }}/edit/?livro_id={{$livro->id}}" ><i class="fas fa-pencil-alt"></i></a>
                        
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
                <li><a href="/instances/create/?livro_id={{$livro->id}}"> <i class="fas fa-plus"></i> Adicionar Exemplar </a></li>
            </ul>
        </div>

      </div>

      <hr>

      <div class="row">

        <div class="col-md  text-break"><h6 class="font-weight-bold">Localização</h6>
          {{ $livro->localizacao_formatada }}
        </div>

      </div>

      <hr>
      
      <div class="row">

        <div class="col-md  text-break"><h6 class="font-weight-bold">Volume</h6>
          {{ $livro->volume }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Editora</h6>
          {{ $livro->editora }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Local</h6>
          {{ $livro->local }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Ano</h6>
          {{ $livro->ano }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Edição</h6>
          {{ $livro->edicao }}
        </div>
      </div>


    </div>
 </div>
</div>

</br>

@endsection('content')

