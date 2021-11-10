
<div class="form-group">

    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Usuário</h5>
            <select class="select-usuarios" name="usuario">
                <option value="" >Digite para procurar o usuários</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->matricula }}">{{ $usuario->matricula }} - {{ $usuario->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md">
            <img width="200px" id="foto" />
        </div>
    </div>


    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Buscar Livro</h5>
            <select class="select-livros" name="livro">
                <option value="default" >Digite para procurar o livros</option>
                @foreach($livros as $livro)
                    <option value="{{ $livro->id }}">{{ $livro->tombo }} - {{ $livro->titulo }} - {{ $livro->autor }}</option>
                @endforeach
            </select>
        </div>

    </div>

    @if(isset($livro))
        <div class="form-row">
            @include('livros.partials.tombo')
        </div>
    @endif 
    <div class="form-row">

        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" name="titulo" id="titulo" value="{{ old('titulo') }}">
        </div>

        <div class="form-group col-md font-weight-bold">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" name="autor"  id="autor" value="{{ old('autor') }}">
        </div>
    </div>

</div>

<div class="col-sm form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>

<script>

@if (!$errors->any())
    $('#tombo').val("");
    $('#tombo_tipo').val("");
@endif

$('.select-usuarios').select2({
    width: '100%',
    language: "pt-BR",
});

$('.select-usuarios').change(function(){
    var matricula = $( '.select-usuarios' ).val();

    function success(response) {
        if(response == 1){
            $( '#foto' ).attr("src",'/foto/' + matricula) ;
        } else {
            $( '#foto' ).removeAttr('src');
        }  
    };
    $.get('/temfoto/' + matricula , {}, success);
});

$('.select-livros').select2({
    width: '100%',
    language: "pt-BR",
});

$('.select-livros').change(function(){
    var livro = $( '.select-livros' ).val();
    
    function success(response) {
        
        $('#tombo').val(response.tombo);
        $('#tombo_tipo').val(response.tombo_tipo);
        $('#titulo').val(response.titulo);
        $('#autor').val(response.autor);
        
        // TODO: zera campo 
        // $("select[name='livro'] option:contains('default')").attr("selected", "selected");
    };
    $.get('/api/livros/' + livro , {}, success);
    
    
});
</script>


