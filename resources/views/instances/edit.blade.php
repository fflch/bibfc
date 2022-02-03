@extends('main')

@section('content')

<form method="POST" action="/instances/{{ $instance->id }}">
@csrf
@method('patch')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Edição do exemplar</h5>
    <div class="card-body">
        @include('instances.form')
    </div>
</div>
</form>
@endsection('content')
