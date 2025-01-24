@extends('adminlte::auth.login')

@section('auth_header')
@endsection

@section('auth_footer')
@endsection

<div class="container">
    <div class="row justify-content-center" style="margin-bottom:12px;">
        <div class="col-4">
            <label for="unidade">Selecione a unidade</label>
            <select class="form-control" name="unidade">
                @foreach(\App\Models\Unidade::all() as $unidade)
                <option value="{{$unidade->id}}">{{$unidade->nome_unidade}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>