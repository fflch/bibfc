<div class="form-group">

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $livro->titulo) }}">
        </div>
        <div class="form-group col-md font-weight-bold">
            <label>Subtítulo</label>
            <input type="text" class="form-control" name="subtitulo" value="{{ old('subtitulo', $livro->subtitulo) }}">
        </div>
        <div class="form-group col-lg-2 font-weight-bold">
            <label for="tipologia">Tipologia</label>
            <select class="form-control" name="tipo">
                <option selected="" value="">- Selecionar -</option>
                @foreach($livro::tipologia() as $tipologia)
                <option value="{{$tipologia}}" name="tipo">{{$tipologia}}</option>
                @endforeach
            </select>
        </div>
        <div class="col" id="inputsContainer">
            <label for="responsabilidade">Autores</label>
            <select class="form-control" name="responsabilidade[]">
                @foreach(\App\Models\Responsabilidade::all() as $livro_responsabilidade)
                    <option value="{{$livro_responsabilidade->id}}">{{$livro_responsabilidade->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-g">
            <a class="btn btn-primary" id="add-select" style="margin-top:1.85rem;">+</a>
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-md font-weight-bold">
            <label for="editora">Editora</label>
            <input type="text" class="form-control" name="editora" value="{{ old('editora', $livro->editora) }}">
        </div>

        <div class="form-group col-md font-weight-bold">
            <label for="local">Local de publicação</label>
            <input type="text" class="form-control" name="local" value="{{ old('local', $livro->local) }}">
        </div>

        <div class="form-group col-lg-1 font-weight-bold">
            <label for="ano">Ano</label>
            <input type="text" class="form-control" name="ano" value="{{ old('ano', $livro->ano) }}">
        </div>

        <div class="form-group col-lg-1 font-weight-bold">
            <label for="edicao">Edição</label>
            <input type="text" class="form-control" name="edicao" value="{{ old('edicao', $livro->edicao) }}">
        </div>


        <div class="form-group col-lg-1 font-weight-bold">
            <label for="volume">Volume</label>
            <input type="text" class="form-control" name="volume" value="{{ old('volume', $livro->volume) }}">
        </div>

        <div class="form-group col-lg-4 font-weight-bold">
            <label for="localizacao">Localização</label>
            <input type="text" class="form-control" name="localizacao" value="{{ old('localizacao', $livro->localizacao) }}">
        </div>
    </div>


    <div class="form-row">

        <div class="form-group col-lg-1 font-weight-bold">
            <label for="isbn">ISBN</label>
            <input type="text" class="form-control" name="isbn" value="{{ old('isbn', $livro->isbn) }}">
        </div>        
        <div class="form-group col-md font-weight-bold">
            <label for="idioma">Idioma</label>
            <select class="form-control" name="idioma">
                @foreach($livro::idiomas() as $idioma)
                <option value="{{$idioma}}">{{$idioma}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md font-weight-bold">
            <label for="serie">Série/Coleção</label>
            <input type="text" class="form-control" name="serie" value="{{ old('serie', $livro->serie) }}">
        </div>
        <div class="form-group col-md font-weight-bold">
            <label for="paginas">Total de páginas</label>
            <input type="text" class="form-control" name="paginas" value="{{ old('paginas', $livro->paginas) }}">
        </div>
    </div>
    

    <div class="form-row">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="sim" name="colorido"

            @if($livro->colorido == 'sim')
            checked
            @endif
            >
            
            <label class="form-check-label" for="colorido">
                Colorido?
            </label>
        </div>

    </div>

    <div class="form-row">
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="sim" name="ilustrado"
            
            @if($livro->ilustrado == 'sim')
            checked
            @endif
            >
            <label class="form-check-label" for="colorido">
                Ilustrado?
            </label>
        </div>

    </div>

    <div class="form-group">
        <label for="obs">Notas</label>
        <textarea class="form-control" name="obs" rows="3">{{ old('obs', $livro->obs) }}</textarea>
    </div>

    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button> 
        </div> 
    </div>

</div>

<script>
document.getElementById('add-select').addEventListener('click', function () {
    let container = document.getElementById('inputsContainer');
    
    let newDiv = document.createElement('div');
    newDiv.classList.add('form-group');

    let select = document.createElement('select');
    select.name = 'responsabilidade[]';
    select.style = "width:80%; padding:8px; border:1px solid #ced4da; border-radius:.25rem; background-color:#fff;";

    // Opções do select
    let defaultOption = document.createElement('option');
    defaultOption.value = '';
    defaultOption.innerText = 'Selecione uma opção';
    select.appendChild(defaultOption);

    @foreach(\App\Models\Responsabilidade::all() as $opcao)
        let option{{ $opcao->id }} = document.createElement('option');
        option{{ $opcao->id }}.value = '{{ $opcao->id }}';
        option{{ $opcao->id }}.innerText = '{{ $opcao->nome}}';
        select.appendChild(option{{ $opcao->id }});
    @endforeach

    let removeButton = document.createElement('button');
    removeButton.innerText = '-';
    removeButton.classList.add('btn', 'btn-danger');
    removeButton.type = 'button';
    removeButton.onclick = function () {
        newDiv.remove();
    };

    newDiv.appendChild(select);
    newDiv.appendChild(removeButton);
    
    container.appendChild(newDiv);
});
</script>