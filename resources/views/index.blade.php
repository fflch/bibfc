@extends('main')

@section('content')
<h4><b>Consulta de materiais</b></h4>
<form method="get" action="/">
    <div class="row">
        <div class="col-md-8">
            <input type="text" name="busca" class="form-control" value="{{request()->busca}}" placeholder="Buscar por autor, título ou ISBN">
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
        </div>
    </div>
</form>
<p>Número de registros: {{$count}}</p>
<table class="table table-striped">
{{ $livros->appends(request()->query())->links() }}
  <thead>
    <tr>
      <th scope="col">Autor</th>
      <th scope="col">Título</th>
      <th scope="col">ISBN</th>
    </tr>
  </thead>
  <tbody>
      @foreach($livros as $livro)
      <tr>
      <td>
        @php
          $autores = explode(', ',$livro->responsabilidades);
        @endphp
        @foreach($autores as $autor)
          <li>
            {{\App\Models\Responsabilidade::nomeAutor($autor)}}
          </li>
        @endforeach
      </td>
      <td><b>{{$livro->titulo}}</b>{{$livro->subtitulo ? ": " . $livro->subtitulo : ''}}</td>
      <td>{{$livro->isbn ?? 'N/A'}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
