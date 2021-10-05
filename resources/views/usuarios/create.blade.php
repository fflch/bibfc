@extends('main')

@section('content')
    <div class="card">
        <div class="card-header"><b></b></div>
        <div class="card-body">
            <form action="/usuarios" method="POST" enctype="multipart/form-data">
                @csrf
                @include('usuarios.form')
            </form>
        </div>
    </div>

@endsection('content')

