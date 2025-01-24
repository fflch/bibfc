@extends('main')

@section('content')

<!--
    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/livros/create" class="btn btn-success">Novo Livro</a>
        </div>
    </div>
-->
    <div class="card">
        <div class="card-header"><b>Pesquisar</b></div>
        <div class="card-body">
            <form method="GET" action="/livros">
                @include('livros.partials.index_search')
            </form>
        </div>
    </div>
    @include('livros.partials.index_table')
    {{ $livros->appends(request()->query())->links() }}

@endsection('content')
