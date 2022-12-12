@extends('main')

@section('content')

<form method="POST" action="/tccs/{{$tcc->id}}">
@csrf
@method('patch')
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Edição de TCC</h5>
    <div class="card-body">
    @include('tccs.form')
    </div>
</div>
</form>
@endsection('content')
