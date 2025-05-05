
@extends('main')

@section('content')

<form method="POST" action="/emprestimos">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Emprestar</h5>
    <div class="card-body">
    @include('emprestimos.form')
    </div>
</div>
</form>
@endsection('content')


