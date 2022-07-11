@extends('main')

@section('content')

<form method="POST" action="/assuntos/{{$assunto->id}}">
@csrf
@method('patch')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Edição</h5>
    <div class="card-body">
    @include('assuntos.form')
    </div>
</div>
</form>
@endsection('content')
