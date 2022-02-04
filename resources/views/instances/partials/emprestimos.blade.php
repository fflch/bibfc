<table class="table">
  <thead>
    <tr>
      <th scope="col">Foto</th>
      <th scope="col">Matrícula</th>
      <th scope="col">Nome</th>
      <th scope="col">Empréstimo</th>
      <th scope="col">Devolução</th>
      <th scope="col">Total de Dias</th>
    </tr>
  </thead>
  <tbody>

    @foreach($instance->emprestimos as $emprestimo)
    <tr>
      <td>
        @if($emprestimo->usuario->tem_foto())
          <img src="/foto/{{ $emprestimo->usuario->matricula }}" width="100px">
        @else 
          <i class="fas fa-user-tie fa-5x"></i>
        @endif
    </td>
      <td>{{ $emprestimo->usuario->matricula }}</td>
      <td><a href="/usuarios/{{ $emprestimo->usuario->id }}">{{ $emprestimo->usuario->nome }}</a></td>
      <td>{{ $emprestimo->data_emprestimo }}</td>
      <td>{{ $emprestimo->data_devolucao }}</td>
      <td>{{ $emprestimo->dias }}</td>
    </tr>
    @endforeach
  </tbody>
</table>