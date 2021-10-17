@extends('main')

@section('content')

<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <h3>Livros Emprestados</h3> 
  </div>
  <table class="table">    
    <tbody>
    @foreach($emprestimos as $emprestimo)
      <tr>
        <th>
          Título do Livro: <a href="/livros/{{ $emprestimo->livro->id }}">{{ $emprestimo->livro->titulo }} </a> <br>
          Tombo: {{ $emprestimo->livro->tombo }} ({{ $emprestimo->livro->tombo_tipo }}) <br>
          Autor: {{ $emprestimo->livro->autor }} <br>
          Localização: {{ $emprestimo->livro->localizacao }}
        </th>
        
        <td>
            @if($emprestimo->usuario->tem_foto())
                <img src="/foto/{{ $emprestimo->usuario->matricula }}" width="150px">
            @else 
                <i class="fas fa-user-tie fa-5x"></i>
            @endif
        </td>

        <td>
          <form class="row-sm" method="POST" action="/emprestimos/{{$emprestimo->id}}">
            @csrf
            <a class="btn btn-outline-success btn-sm" href="/emprestimos/{{$emprestimo->id}}/edit">Devolver</i></a><br><br>
            <a class="btn btn-outline-success btn-sm" href="/renovar/{{$emprestimo->id}}">Renovar</i></a>
          </form>
        </td>
      </tr>
      <tr>
        <td class="border-top-0 ">
          Emprestado para: {{ $emprestimo->usuario->matricula }}  - {{ $emprestimo->usuario->nome}}<br>
        </td>
        <td class="border-top-0 ">
          Data do Empréstimo: {{ $emprestimo->data_emprestimo }} <br>
          Prazo para devolução: {{ $emprestimo->prazo }} 
          @if($emprestimo->atrasado) <span style="color:red;"> (Atrasado)</span> @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>



@endsection('content')
