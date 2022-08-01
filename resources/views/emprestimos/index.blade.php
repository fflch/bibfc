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
      @include('emprestimos.partials.tremprestimo')
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
