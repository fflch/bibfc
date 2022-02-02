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

</br>

@endsection('content')

