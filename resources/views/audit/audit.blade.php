@extends('main')

@section('content')

<h2>Auditoria</h2>

{{$audits->appends(request()->query())->links()}}

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Data</th>
      <th scope="col">Usuário(a)</th>
      <th scope="col">Entidade Alterado</th>
      <th scope="col">Evento</th>
      <th scope="col">valor antigo</th>
      <th scope="col">valor novo</th>
      <th scope="col">url</th>
    </tr>
  </thead>
  <tbody>
    @foreach($audits as $audit)

        <tr>
            <td> 
                {{ Carbon\Carbon::parse($audit->created_at)->format('d/m/Y H:i') }}
            </td>
            <td> 
                {{ \App\Models\User::find($audit->user_id)->email ?? 'Não encontrado' }}
            </td>

            <td> 
                {{ str_replace('App\\Models\\','',$audit->auditable_type) }}
            </td>

            <td> 
                {{ $audit->event }}
            </td>

            <td> 
                {!! implode('<br>',$audit->old_values) !!}
            </td>
            <td> 
                {!! implode('<br>',$audit->new_values) !!}
            </td>

            <td> 
                <a href="{{$audit->url}}">{{ $audit->url }}</a>
            </td>

        </tr>
    @endforeach
  </tbody>
</table>

{{$audits->appends(request()->query())->links()}}

@endsection('content')