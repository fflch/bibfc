@extends('main')

@section('content')

<form method="POST" action="/livros/{{$livro->id}}">
@csrf
@method('patch')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Edição de Livro</h5>
    <div class="card-body">
    @include('livros.form')
    </div>
</div>
</form>
@endsection('content')
