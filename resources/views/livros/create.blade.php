@extends('main')

@section('content')

<form method="POST" action="/livros">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Novo Livro</h5>
    <div class="card-body">
    @include('livros.form')
    </div>
</div>
</form>
@endsection('content')
