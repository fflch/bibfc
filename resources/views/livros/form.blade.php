<div class="form-group">

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $livro->titulo) }}">
        </div>

        <div class="form-group col-md font-weight-bold">
            <label for="autor">Autor</label>
            <input type="text" class="form-control" name="autor" value="{{ old('autor', $livro->autor) }}">
        </div>
    </div>

    <div class="form-row">
        @include('livros.partials.tombo')
    </div>

    <div class="form-row">

        <div class="form-group col-md font-weight-bold">
            <label for="editora">Editora</label>
            <input type="text" class="form-control" name="editora" value="{{ old('editora', $livro->editora) }}">
        </div>

        <div class="form-group col-md font-weight-bold">
            <label for="local">Local</label>
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
            <label for="exemplar">Exemplar</label>
            <input type="number" class="form-control" name="exemplar" value="{{ old('exemplar', $livro->exemplar) }}">
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

    <div class="form-group">
        <label for="obs">Observações</label>
        <textarea class="form-control" name="obs" rows="3">{{ old('obs', $livro->obs) }}</textarea>
    </div>

    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button> 
        </div> 
    </div>

</div>
