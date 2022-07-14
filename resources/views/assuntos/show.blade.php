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
      <br>
      <div class="row">

        <div class="col-md text-break"><h6 class="font-weight-bold">Caminho</h6>
          
          <br>
          @if ($tg = \App\Models\Assunto::where('id',$assunto->parent_id)->first() )
          TG: <a href="/assuntos/{{ $tg->id }}">{{ $tg->titulo }}</a> <br>
          @endif
  
          <b>{{ $assunto->titulo }}</b>
          

          @if ($tes = \App\Models\Assunto::where('parent_id',$assunto->id)->get() )
          <br>
            @foreach($tes as $te)
              TE: <a href="/assuntos/{{ $te->id }}">{{ $te->titulo }}</a> 

              @if ($te->children->isNotEmpty())
                (+)
              @endif
              <br>
            @endforeach
          @endif

          @if ($trs = \App\Models\Assunto::where('parent_id',$assunto->parent_id)->where('id','!=',$assunto->id)->get() )
            <br>
            @foreach($trs as $tr)
              TR: <a href="/assuntos/{{ $tr->id }}">{{ $tr->titulo }}</a> <br>
            @endforeach
          @endif

          <br>
        </div>

      </div>

      <hr>

    </div>
 </div>
</div>

@endsection('content')

