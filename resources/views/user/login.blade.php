@extends('main')

@section("content")
<div class="container">
    <div class="row justify-content-center" style="margin-bottom:12px;">
        <div class="col-4">
            <form method="post" action="/login">
            @csrf
            <label for="unidade">Selecione a unidade</label>
            <select class="form-control" name="unidade_id">
                @foreach(\App\Models\Unidade::all() as $unidade)
                <option value="{{$unidade->id}}">{{$unidade->nome_unidade}} - {{$unidade->localizacao_unidade}}</option>
                @endforeach
            </select>
            <label>E-mail</label>
            <input type="text" class="form-control" name="email" value="{{old('email', session('email'))}}">
            <label>Senha</label>
            <input type="password" class="form-control" name="password">
            <button type="submit" class="btn btn-success">Login</button>
            </form>
        </div>
    </div>
</div>

@endsection
