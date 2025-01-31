<td>
    <b>Título</b>: <a href="/livros/{{ $emprestimo->instance->livro->id }}">{{ $emprestimo->instance->livro->titulo }} {{$emprestimo->instance->livro->subtitulo}}</a> <br>
    <b>Tombo</b>: <a href="/instances/{{ $emprestimo->instance->id }}">{{ $emprestimo->instance->tombo }} ({{ $emprestimo->instance->tombo_tipo }}) </a> <br>
    <b>Renovações:</b> {{ $emprestimo->renew }} <br>
    <b>Autor:</b> 
    
    <ul>
    @forelse($emprestimo->instance->livro->responsabilidades as $responsabilidade)
        <li>{{ $responsabilidade->nome }} {{$responsabilidade->sobrenome}} ({{ $responsabilidade->pivot->tipo }})</li>
    @empty
        <li>Não há Autor cadastrado</li>
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
    
    <b>Emprestado para:</b> {{ $emprestimo->usuario->matricula }} - <a href="/usuarios/{{ $emprestimo->usuario->id }}">{{ $emprestimo->usuario->nome }} </a><br>
    {{ $emprestimo->usuario->turma }} <br>

    @if($emprestimo->data_devolucao == null) 
        <b>Prazo para devolução:</b> {{ $emprestimo->prazo }} <br>
        @if($emprestimo->atrasado) <span style="color:red;"> (Atrasado)</span> @endif
    @else
        <b>Devolvido em:</b> {{ $emprestimo->data_devolucao }}
    @endif
</td>
 
<td>
    @if($emprestimo->data_devolucao == null)
        <a class="btn btn-outline-success btn-sm" href="/emprestimos/{{$emprestimo->id}}/edit">Devolver</i></a><br><br>
        <a class="btn btn-outline-success btn-sm" href="/renovar/{{$emprestimo->id}}">Renovar</i></a>
    @endif
</td>
