@extends('main')

@section('content')

Total de Empréstimos em <b>aberto:</b> {{ $emprestimos->count() }} <br>
Total de Empréstimos <b>finalizados:</b> {{ $emprestimos_finalizados }} <br> <br>


<div class="card bg-light">
  <div class="card-header border-info bg-light">
    <h4>Livros Emprestados</h4> 
  </div>

  <table class="table" id="emprestimos">
  <thead>
    <tr>
      <th scope="col">Empréstimo</th>
      <th scope="col">Foto</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  @foreach($emprestimos as $emprestimo)
    <tr>
      <td>
          <b>Título</b>: <a href="/livros/{{ $emprestimo->instance->livro->id }}">{{ $emprestimo->instance->livro->titulo }} </a> <br>
          <b>Tombo:</b> {{ $emprestimo->instance->tombo }} ({{ $emprestimo->instance->tombo_tipo }}) <br>
          <b>Renovações:</b> {{ $emprestimo->renew }} <br>
          <b>Responsabilidade:</b> 
          
          <ul>
            @forelse($emprestimo->instance->livro->responsabilidades as $responsabilidade)
              <li>{{ $responsabilidade->nome }} ({{ $responsabilidade->pivot->tipo }})</li>
            @empty
              <li>Não há Responsabilidade cadastrada</li>
            @endforelse
          </ul>

          @if($emprestimo->instance->livro->localizacao_formatada)
            <b>Localização:</b> {{ $emprestimo->instance->livro->localizacao_formatada }} <br>
          @endif
          
          <br> <i> {{ $emprestimo->obs }} </i> <br>
      </td>
      <td>
          @if($emprestimo->usuario->tem_foto())
            <img src="/foto/{{ $emprestimo->usuario->matricula }}" width="150px">
          @else 
            <i class="fas fa-user-tie fa-5x"></i>
          @endif
          <br>
          <b>Data do Empréstimo:</b> {{ $emprestimo->data_emprestimo }} <br>
          <b>Prazo para devolução:</b> {{ $emprestimo->prazo }} <br>
          <b>Emprestado para:</b> {{ $emprestimo->usuario->matricula }} - <a href="/usuarios/{{ $emprestimo->usuario->id }}">{{ $emprestimo->usuario->nome }} </a><br>
          {{ $emprestimo->usuario->turma }} <br>
          @if($emprestimo->atrasado) <span style="color:red;"> (Atrasado)</span> @endif
      </td>
      <td>
          <a class="btn btn-outline-success btn-sm" href="/emprestimos/{{$emprestimo->id}}/edit">Devolver</i></a><br><br>
          <a class="btn btn-outline-success btn-sm" href="/renovar/{{$emprestimo->id}}">Renovar</i></a>
     </td>
    </tr>
  @endforeach
  </tbody>
</table>

</div>

<script>

$('#emprestimos').DataTable( {
    dom: 'fBitp', // https://datatables.net/examples/basic_init/dom.html
    select: true,
    "paging": false,
    "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/pt_pt.json"
    },
    'info': ''
    
} );
</script>

@endsection('content')
