
<div class="form-group">

    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Usuário</h5>
            <select class="select-usuarios" name="usuario">
                <option value="" >Digite para procurar o usuários</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->matricula }}">{{ $usuario->matricula }} - {{ $usuario->nome }}</option>
                @endforeach
            </select>

            <div class="emprestados_titulo" style="color:red;">Livros já emprestados:</div>
            <ul class="emprestados_lista" style="color:red;"></ul>

        </div>

        <div class="form-group col-md">
            <img width="200px" id="foto" />
        </div>
    </div>


    <div class="form-row">

        <div class="form-group col"><h5 class="font-weight-bold">Buscar Livro</h5>
            <select class="select-livros" name="instance_id">
                <option value="default" >Digite para procurar o livros</option>
                @foreach($instances as $instance)
                    <option value="{{ $instance->id }}">{{ $instance->tombo }} ({{ $instance->tombo_tipo }}) - {{ $instance->livro->titulo }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <div class="form-group">
        <label for="obs">Observações sobre este empréstimo</label>
        <textarea class="form-control" name="obs" rows="3">{{ old('obs') }}</textarea>
    </div>

</div>

<div class="col-sm form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>

<script>

$('.emprestados_titulo').hide();

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

    // Livros emprestados desse usuários
    function successEmprestimos(response) {
        $('.emprestados_lista').empty();
        $('.emprestados_titulo').show();

        if(response.length == 0 ){
            $('.emprestados_titulo').hide();
        }

        for(var item in response) {
            $text = response[item].tombo + " (" + response[item].tombo_tipo + "): " + response[item].titulo;
            $('.emprestados_lista').append( '<li>' + $text + '</li>' );
        }
    };
    $.get('/json_emprestimos_ativos/' + matricula , {}, successEmprestimos);
});

$('.select-livros').select2({
    width: '100%',
    language: "pt-BR",
});

</script>


