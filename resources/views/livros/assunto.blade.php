@extends('main')

@section('content')

<form method="POST" action="/livro_assuntos/{{ $livro->id }}">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Adicionar Termo</h5>
    <div class="card-body">

    <b>Livro:</b> {{ $livro->titulo }} <br><br>
    
    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Termos</h5>
            <select class="select-assunto" name="assunto_id">
                <option value="default" >Buscar ...</option>
                @foreach($assuntos as $assunto)
                    <option value="{{$assunto->id}}">
                        {{$assunto->titulo}}
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button> 
        </div> 
    </div>

</div>
</form>

<script>
    $('.select-assunto').select2({
        width: '100%',
        language: "pt-BR",
    });
</script>

@endsection('content')

