@extends('main')


@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">

      <a class="btn btn-outline-success btn-md" href="/assuntos/{{$assunto->id}}/edit">Editar</a>
      
      <form method="POST" action="/assuntos/{{ $assunto->id }}" style="display:inline">
          @csrf 
          @method('delete')
          <button type="submit" class="delete-item btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Deletar</button>
      </form>

      <div class="row">

        <div class="col-md text-break"><h6 class="font-weight-bold">Assunto</h6>
          {{ $assunto->titulo }}
        </div>

      </div>

      <hr>

    </div>
 </div>
</div>

@endsection('content')

