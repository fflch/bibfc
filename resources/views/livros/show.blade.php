@extends('main')


@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">
      <a class="btn btn-outline-success btn-md" href="/livros/{{$livro->id}}/edit" role="button">Editar</a> <br><br>
      <div class="row">
        <div class="col-md text-break"><h6 class="font-weight-bold">Título</h6>
          {{ $livro->titulo }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Autor</h6>
          {{ $livro->autor }}
        </div>

      </div>

      <hr>

      <div class="row">
        <div class="col-md text-break"><h6 class="font-weight-bold">Tombo</h6>
          {{ $livro->tombo }} - {{ $livro->tombo_tipo }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Localização</h6>
          {{ $livro->localizacao }}
        </div>
      </div>

      <hr>
      
      <div class="row">
        <div class="col-md text-break"><h6 class="font-weight-bold">Exemplar</h6>
          {{ $livro->exemplar }}
        </div>

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

@include('livros.partials.emprestimos')

@endsection('content')

