<div class="form-group">

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Título *</label>
            <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $livro->titulo) }}">
        </div>
        <div class="form-group col-md font-weight-bold">
            <label>Subtítulo</label>
            <input type="text" class="form-control" name="subtitulo" value="{{ old('subtitulo', $livro->subtitulo) }}">
        </div>
        <div class="col" id="inputsContainer">
            <label for="responsabilidade">Autores *</label>
            <select class="select-responsabilidade" name="responsabilidade[]">
                <option value="" name="">- Selecionar - </option>
                @foreach(\App\Models\Responsabilidade::orderBy('nome','asc')->get() as $livro_responsabilidade)
                    <option value="{{$livro_responsabilidade->id}}"
                    {{ (in_array($livro_responsabilidade->id, old('responsabilidade', [])) || in_array($livro_responsabilidade->id, $livro->livro_responsabilidades->pluck('responsabilidade_id')->toArray())) ? 'selected' : '' }}>
                    {{ $livro_responsabilidade->nome }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="col" id="inputsContainer2">
            <label for="tipo">Função do autor *</label>
            <select class="select-tipo" name="tipo[]">
                <option value="" name="">- Selecionar -</option>
                @foreach(\App\Models\LivroResponsabilidade::tipos as $tipos)
                @if(old('tipo') == '' and isset($livro_responsabilidade1))
                {{-- Tentativa de Edição --}}
                    <option value="{{$tipos}}" {{ ($livro_responsabilidade1 == $tipos) ? 'selected' : '' }}>
                        {{$tipos}}
                    </option>
                    @else
                {{-- Tentativa de Cadastro --}}
                    <option value="{{ $tipos }}" {{ in_array($tipos, old('tipo', $livro->livro_responsabilidades->pluck('tipo')->toArray() )) ? 'selected' : '' }}>
                        {{ $tipos }}
                    </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-g">
            <a class="btn btn-primary" id="add-select" style="margin-top:1.85rem;"><i class="fas fa-plus"></i></a>
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
            <label for="localizacao">Localização *</label>
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
            <small>somente números</small>
        </div>
        <div class="form-group col font-weight-bold" id="inputsContainer3">
            <label for="assunto">Assunto *</label>
            <select class="select-assuntos" name="assunto[]">
                <option value="" name="">- Selecionar -</option>
                @foreach(\App\Models\Assunto::all() as $assunto)
                @if(old('assunto') == '' and isset($livro_assunto))
                {{-- Tentativa de edição --}}
                <option value="{{$assunto->id}}" {{ in_array($assunto->id, old('assunto', $livro->assuntos->pluck('id')->toArray() )) ? 'selected' : '' }}>
                    {{$assunto->titulo}}
                </option>
                @else 
                <option value="{{$assunto->id}}" {{ in_array($assunto->id, old('assunto', $livro_assunto ?? [])) ? 'selected' : '' }}>
                    {{$assunto->titulo}}
                </option>
                {{-- Tentativa de cadastro --}}
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-g">
            <a class="btn btn-primary" id="add-select2" style="margin-top:1.85rem"><i class="fas fa-plus"></i></a>
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
    
    <small>*Os campos com asterísco são obrigatórios</small>
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
    let assuntos = @json($livro->assuntos->pluck('id'));
    {{-- let assuntos = @json($livro_assunto->pluck('assunto_id')); --}}
    

    let container = document.getElementById('inputsContainer');
    let container2 = document.getElementById('inputsContainer2');
    let container3 = document.getElementById('inputsContainer3');
    let addButton = document.getElementById('add-select');
    let addButton2 = document.getElementById('add-select2');

    function addSelect(responsabilidadeSelecionada = null, tipoSelecionado = null) {
        let newDiv = document.createElement('div');
        newDiv.classList.add('form-group');
        newDiv.style="margin-top:0.55rem; margin-bottom:0 !important;";

        let newDiv2 = document.createElement('div');
        newDiv2.classList.add('form-group');
        newDiv2.style="margin-top:0.55rem; margin-bottom:0 !important; margin-right:-25%;";
        
        let select = document.createElement('select');
        select.name = 'responsabilidade[]';
        select.classList.add('form-control');
        
        let select2 = document.createElement('select');
        select2.name = 'tipo[]';
        select2.classList.add('form-control');
        select2.style= "width:80%; display:initial; !important;";

        let defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.innerText = '- Selecionar -';
        select.appendChild(defaultOption);

        let defaultOption2 = document.createElement('option');
        defaultOption2.value = '';
        defaultOption2.innerText = '- Selecionar -';
        select2.appendChild(defaultOption2);

    function validaCampos(){
        setTimeout(() => {
            [select, select2].forEach(el => {
            el.classList.toggle('blinking-border', !el.value);
        });
        }, 100);
    }
    
    validaCampos();
    select.addEventListener("change",validaCampos);
    select2.addEventListener("change",validaCampos);
    setTimeout(validaCampos, 200);
    
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
        let trash = document.createElement('i');
        trash.classList.add('fas','fa-trash');
        removeButton.style = "margin-left:8px;";
        removeButton.appendChild(trash);
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

    function addSelect2(assuntoSelecionado = null){
        let addButton2 = document.getElementById('add-select2');

        let newDiv3 = document.createElement('div');
        newDiv3.classList.add('form-group');
        newDiv3.style="margin-top:0.55rem; margin-bottom:0 !important; margin-right:-25%;";

        let select3 = document.createElement('select');
        select3.name = 'assunto[]';
        select3.classList.add('form-control');
        select3.style = "width:80%; display:initial; !important;";

        let defaultOption3 = document.createElement('option');
        defaultOption3.value = '';
        defaultOption3.innerText = '- Selecionar -';
        select3.appendChild(defaultOption3);

        let removeButton2 = document.createElement('a');
        let trash = document.createElement('i');
        trash.classList.add('fas','fa-trash');
        removeButton2.style="margin-left:8px";
        removeButton2.classList.add('btn', 'btn-danger');
        removeButton2.appendChild(trash);
        removeButton2.onclick = function (){
            newDiv3.remove();
        }

        @foreach(\App\Models\Assunto::all() as $assunto)
            let option{{ $assunto->id }} = document.createElement('option');
            option{{ $assunto->id }}.value = '{{ $assunto->id }}';
            option{{ $assunto->id }}.innerText = '{{ $assunto->titulo }}';
            
            if (assuntoSelecionado == '{{ $assunto->id }}') {
                option{{ $assunto->id }}.selected = true;
            }
            select3.appendChild(option{{ $assunto->id }});
        @endforeach

        newDiv3.appendChild(select3);
        newDiv3.appendChild(removeButton2);
        container3.appendChild(newDiv3);
    }


    // Adiciona selects ao clicar no botão
    addButton.addEventListener('click', function () {
        addSelect();
    });

    addButton2.addEventListener('click', function (){
        addSelect2();
    });

    // Preencher selects já cadastrados na edição
    if (responsabilidades.length > 0) {
        for (let i = 1; i < responsabilidades.length; i++) {
            addSelect(responsabilidades[i], tipos[i]);
        }

    }
    if (assuntos.length > 0){
        for(let a = 1; a < assuntos.length; a++){
            addSelect2(assuntos[a]);
        }
    }
});


$('.select-responsabilidade').select2({
    width: '100%',
    language: "pt-BR",
});

$('.select-tipo').select2({
    width: '100%',
    language: "pt-BR",
});


$('.select-assuntos').select2({
    width: '100%',
    language: "pt-BR",
});


</script>
<style>
    @keyframes piscar {
    0% { border-color: rgba(255, 0, 0, 1); }
    50% { border-color: rgba(255, 0, 0, 0.3); }
    100% { border-color: rgba(255, 0, 0, 1); }
}

.blinking-border {
    animation: piscar 1s infinite;
}
</style>