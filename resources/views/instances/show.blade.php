@extends('main')


@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">

      <a class="btn btn-outline-success btn-md" href="/responsabilidades/{{$responsabilidade->id}}/edit">Editar</a> <br><br>
      
      <div class="row">

        <div class="col-md text-break"><h6 class="font-weight-bold">Nome</h6>
          {{ $responsabilidade->nome }}
        </div>

      </div>

      <hr>
      
      <div class="row">

        <div class="col-md  text-break"><h6 class="font-weight-bold">Ano Nascimento</h6>
          {{ $responsabilidade->ano_nascimento }}
        </div>

        <div class="col-md  text-break"><h6 class="font-weight-bold">Ano Falecimento</h6>
          {{ $responsabilidade->ano_falecimento }}
        </div>

      </div>


    </div>
 </div>
</div>

@if($responsabilidade->livros()->get()->isNotEmpty())
<h4>Livros relacionados</h4>
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col">Título</th>
    </tr>
  </thead>
  <tbody>
    @forelse($responsabilidade->livros()->get() as $livro)
      <tr>
        <td><a href="/livros/{{ $livro->id }}">{{ $livro->titulo }}</a></td>
      </tr>
    @empty
      <tr>
        <td>Responsabilidade não utilizada em nenhum registro</td>
      </tr> 
    @endforelse

  </tbody>
</table>




@endsection('content')

