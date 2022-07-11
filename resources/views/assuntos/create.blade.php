@extends('main')

@section('content')

<form method="POST" action="/assuntos">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Novo assunto</h5>
    <div class="card-body">
    @include('assuntos.form')
    </div>
</div>
</form>
@endsection('content')
