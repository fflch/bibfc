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
            <select class="form-control" name="tipologia">
                <option selected="" value="">- Selecionar -</option>
                @foreach($livro::tipologia() as $tipologia)
                <option value="{{$tipologia}}">{{$tipologia}}</option>
                @endforeach
            </select>
        </div>
        <div class="col" id="inputsContainer">
            <label for="responsabilidade">Autores</label>
            <select class="form-control" name="responsabilidade[]">
                <option value="" name="">- Selecionar - </option>
                @foreach(\App\Models\Responsabilidade::all() as $livro_responsabilidade)
                    <option value="{{$livro_responsabilidade->id}}">{{$livro_responsabilidade->nome}}</option>
                @endforeach
            </select>
        </div>
        <div class="col" id="inputsContainer2">
            <label for="tipo">Tipo</label>
            <select class="form-control" name="tipo[]">
                <option value="-" name="">- Selecionar -</option>
                @foreach(\App\Models\LivroResponsabilidade::tipos as $tipos)
                    <option value="{{$tipos }}">{{$tipos}}</option>
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
    document.addEventListener('DOMContentLoaded', function () {

    let responsabilidades = @json($livro->livro_responsabilidades->pluck('responsabilidade_id'));
    let tipos = @json($livro->livro_responsabilidades->pluck('tipo'));

    let container = document.getElementById('inputsContainer');
    let container2 = document.getElementById('inputsContainer2');
    let addButton = document.getElementById('add-select');

    function addSelect(responsabilidadeSelecionada = null, tipoSelecionado = null) {
        let newDiv = document.createElement('div');
        newDiv.classList.add('form-group');

        let newDiv2 = document.createElement('div');
        newDiv2.classList.add('form-group');

        let select = document.createElement('select');
        select.name = 'responsabilidade[]';
        select.style = "width:100%; padding:8px; border:1px solid #ced4da; border-radius:.25rem; background-color:#fff;";

        let defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.innerText = '- Selecionar -';
        select.appendChild(defaultOption);

        let select2 = document.createElement('select');
        select2.name = 'tipo[]';
        select2.style = "width:80%;padding:8px; border:1px solid #ced4da; border-radius:.25rem; background-color:#fff;";

        let defaultOption2 = document.createElement('option');
        defaultOption2.value = '';
        defaultOption2.innerText = '- Selecionar -';
        select2.appendChild(defaultOption2);

        // Criando opções para responsabilidade
        @foreach(\App\Models\Responsabilidade::all() as $opcao)
            let option{{ $opcao->id }} = document.createElement('option');
            option{{ $opcao->id }}.value = '{{ $opcao->id }}';
            option{{ $opcao->id }}.innerText = '{{ $opcao->nome }}';
            
            if (responsabilidadeSelecionada == '{{ $opcao->id }}') {
                option{{ $opcao->id }}.selected = true;
            }

            select.appendChild(option{{ $opcao->id }});
        @endforeach

        // Criando opções para tipo
        @foreach(\App\Models\LivroResponsabilidade::tipos as $tipos)
            let option{{ $tipos }} = document.createElement('option');
            option{{ $tipos }}.value = '{{ $tipos }}';
            option{{ $tipos }}.innerText = '{{ $tipos }}';
            
            if (tipoSelecionado == '{{ $tipos }}') {
                option{{ $tipos }}.selected = true;
            }

            select2.appendChild(option{{ $tipos }});
        @endforeach

        let removeButton = document.createElement('button');
        removeButton.innerText = '-';
        removeButton.classList.add('btn', 'btn-danger');
        removeButton.type = 'button';
        removeButton.onclick = function () {
            newDiv.remove();
            newDiv2.remove();
        };

        newDiv.appendChild(select);
        newDiv2.appendChild(select2);
        newDiv2.appendChild(removeButton);

        container.appendChild(newDiv);
        container2.appendChild(newDiv2);
    }

    // Adiciona selects ao clicar no botão
    addButton.addEventListener('click', function () {
        addSelect();
    });

    // Preencher selects já cadastrados na edição
    if (responsabilidades.length > 0) {
        for (let i = 0; i < responsabilidades.length; i++) {
            addSelect(responsabilidades[i], tipos[i]);
        }
    }
});
</script>
