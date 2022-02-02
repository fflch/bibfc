<div class="form-group">

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ old('nome', $responsabilidade->nome) }}">
        </div>
    </div>


    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Ano Nascimento</label>
            <input type="text" class="form-control" name="ano_nascimento" value="{{ old('ano_nascimento', $responsabilidade->ano_nascimento) }}">
        </div>

        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Ano Falecimento</label>
            <input type="text" class="form-control" name="ano_falecimento" value="{{ old('ano_falecimento', $responsabilidade->ano_falecimento) }}">
        </div>

    </div>

    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button> 
        </div> 
    </div>

</div>
