@extends('main')

@section("content")

<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="store">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <label for="unidade">Selecione a unidade</label>
                        <select class="form-control" name="unidade_id">
                        @foreach($unidades->get() as $unidade)
                        <option value="{{$unidade->id}}">{{$unidade->nome_unidade}} - {{$unidade->localizacao_unidade}}</option>
                        @endforeach
                        </select>
                        <label>Nome</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name ) }}">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="{{ old('email', $user->email ) }}">
                        <label>Senha</label>
                        <input type="password" class="form-control" name="password" value=" ">
                        <button type="submit" class="btn btn-success">Registrar usuário</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection