@extends('main')

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <div class="container">

      <a class="btn btn-outline-success btn-md" href="/tccs/{{$tcc->id}}/edit">Editar</a> 

      <form method="POST" action="/tccs/{{ $tcc->id }}" style="display:inline">
          @csrf 
          @method('delete')
          <button type="submit" class="delete-item btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')">Deletar</button>
      </form>

      <br><br>

      <div class="row">
        <div class="col-md text-break"><b>Título:</b> {{ $tcc->titulo }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Autores:</b> {{ $tcc->autores }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Orientador:</b> {{ $tcc->orientador }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Coorientador:</b> {{ $tcc->coorientador }} </div>
      </div>
      
      <div class="row">
        <div class="col-md text-break"><b>Curso:</b> {{ $tcc->curso }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Ano:</b> {{ $tcc->ano }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Extensao:</b> {{ $tcc->extensao }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Localizacao:</b> {{ $tcc->localizacao }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Resumo:</b> <br>{{ $tcc->resumo }} </div>
      </div>

      <div class="row">
        <div class="col-md text-break"><b>Arquivo PDF:</b>  
          @forelse($tcc->files as $file)
            <a href="/files/{{$file->id}}"><i class="fas fa-file-pdf"></i> {{$file->original_name}} </a>
          @empty 
            Não há arquivo pdf
          @endforelse
        </div>
      </div>
    
    </div>
 </div>
</div>

</br>

@endsection('content')

