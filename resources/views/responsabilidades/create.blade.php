@extends('main')

@section('content')

<form method="POST" action="/responsabilidades">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Nova responsabilidade</h5>
    <div class="card-body">
    @include('responsabilidades.form')
    </div>
</div>
</form>
@endsection('content')
