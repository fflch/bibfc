<table class="table">
  <thead>
    <tr>
      <th scope="col">Tombo</th>
      <th scope="col">Tipo</th>
      <th scope="col">Título</th>
      <th scope="col">Observações</th>
      <th scope="col">Empréstimo</th>
      <th scope="col">Devolução</th>
      <th scope="col">Total de Dias</th>
    </tr>
  </thead>
  <tbody>

    @foreach($emprestimos as $emprestimo)
    <tr>
      <td><a href="/instances/{{ $emprestimo->instance->id }}"> {{ $emprestimo->instance->tombo }}</a></td>
      <td>{{ $emprestimo->instance->exemplar }}</td>
      <td><a href="/livros/{{ $emprestimo->instance->livro->id }}">{{ $emprestimo->instance->livro->titulo }}</a></td>
      <td>{{ $emprestimo->obs }}</td>
      <td>{{ $emprestimo->data_emprestimo }}</td>
      <td>{{ $emprestimo->data_devolucao }}</td>
      <td>{{ $emprestimo->dias }}</td>
    </tr>
    @endforeach
  </tbody>
</table>