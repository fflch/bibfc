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

    @foreach($livro->emprestimos as $emprestimo)
    <tr>
      <td> <img src="/foto/{{ $emprestimo->usuario->matricula }}" width="100px"> </td>
      <td><a href="/usuarios/{{ $emprestimo->usuario->id }}">{{ $emprestimo->usuario->nome }}</a></td>
      <td>{{ $emprestimo->usuario->matricula }}</td>
      <td>{{ $emprestimo->usuario->nome }}</td>
      <td>{{ $emprestimo->data_emprestimo }}</td>
      <td>{{ $emprestimo->data_devolucao }}</td>
      <td>{{ $emprestimo->dias }}</td>
    </tr>
    @endforeach
  </tbody>
</table>