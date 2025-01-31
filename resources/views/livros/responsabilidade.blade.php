@extends('main')

@section('content')

<form method="POST" action="/livro_responsabilidades/{{ $livro->id }}">
@csrf
<div class="card bg-light">
    <h5 class="card-header border-info bg-light font-weight-bold">Adicionar Autor</h5>
    <div class="card-body">

    <b>Livro:</b> {{ $livro->titulo }} <br><br><br>
    
    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Autor</h5>
            <select class="select-responsabilidade" name="responsabilidade_id">
                <option value="default" >Buscar ...</option>
                @foreach($responsabilidades as $responsabilidade)
                    <option value="{{$responsabilidade->id}}">
                        {{$responsabilidade->nome}}
                        @if($responsabilidade->ano_nascimento | $responsabilidade->ano_falecimento)
                            ({{ $responsabilidade->ano_nascimento}} - {{$responsabilidade->ano_falecimento}})
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Função do Autor</h5>
            <select name="tipo">
                <option value="" selected> - Selecione - </option>
                @foreach($tipos as $tipo)
                    <option value="{{$tipo}}">
                        {{$tipo}}
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
    $('.select-responsabilidade').select2({
        width: '100%',
        language: "pt-BR",
    });
</script>


@endsection('content')

