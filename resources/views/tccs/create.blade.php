@extends('main')

@section('content')

<form method="POST" action="/tccs">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Novo TCC</h5>
    <div class="card-body">
    @include('tccs.form')
    </div>
</div>
</form>
@endsection('content')
