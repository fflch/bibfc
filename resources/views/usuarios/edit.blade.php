@extends('main')

@section('content')
    <div class="card">
        <div class="card-header"><b>Edição de usuario</b></div>
        <div class="card-body">
            <form action="/usuarios/{{$usuario->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('usuarios.form')
            </form>
        </div>
    </div>

@endsection('content')

