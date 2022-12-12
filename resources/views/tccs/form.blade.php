<div class="form-group">

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $tcc->titulo) }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Autores</label>
            <input type="text" class="form-control" name="autores" value="{{ old('autores', $tcc->autores) }}">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Orientador</label>
            <input type="text" class="form-control" name="orientador" value="{{ old('orientador', $tcc->orientador) }}">
        </div>

        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Co-orientador</label>
            <input type="text" class="form-control" name="coorientador" value="{{ old('coorientador', $tcc->coorientador) }}">
        </div>
    </div>

    <div class="form-row">

        <div class="form-group col-md font-weight-bold">
            <label for="editora">Curso</label>
            <input type="text" class="form-control" name="curso" value="{{ old('curso', $tcc->curso) }}">
        </div>

        <div class="form-group col-lg-1 font-weight-bold">
            <label for="ano">Ano</label>
            <input type="text" class="form-control" name="ano" value="{{ old('ano', $tcc->ano) }}">
        </div>

        <div class="form-group col-lg-1 font-weight-bold">
            <label for="extensao">Extensão</label>
            <input type="text" class="form-control" name="extensao" value="{{ old('extensao', $tcc->extensao) }}">
        </div>

        <div class="form-group col-lg-4 font-weight-bold">
            <label for="localizacao">Localização</label>
            <input type="text" class="form-control" name="localizacao" value="{{ old('localizacao', $tcc->localizacao) }}">
        </div>

    </div>

    <div class="form-group">
        <label for="obs">Resumo</label>
        <textarea class="form-control" name="resumo" rows="5">{{ old('resumo', $tcc->resumo) }}</textarea>
    </div>

    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button> 
        </div> 
    </div>

</div>
