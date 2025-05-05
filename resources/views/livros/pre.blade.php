@extends('main')

@section('content')

<div class="card">
    <div class="card-header"><b></b></div>
    <div class="card-body">
        <form method="GET" action="/pre">
            @include('livros.partials.index_search')
        </form>
    </div>
</div>

@include('livros.partials.pre_table')

@endsection('content')
