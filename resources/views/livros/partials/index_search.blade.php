<div class="row form-group">
    <div class="col-sm">
        <input type="text" class="form-control" name="titulo" value="{{ Request()->titulo }}" placeholder="Título">
    </div>
    <div class="col-sm">
        <input type="text" class="form-control" name="tombo" value="{{ Request()->tombo }}" placeholder="Tombo">
    </div>
    <div class="col-sm">
        <input type="text" class="form-control" name="responsabilidade" value="{{ Request()->responsabilidade }}" placeholder="Autor">
    </div>
    <div class="col-sm">
        <input type="text" class="form-control" name="localizacao" value="{{ Request()->localizacao }}" placeholder="Localização">
    </div>
    <div class="col-sm">
        <input type="text" class="form-control" name="assunto" value="{{ Request()->assunto }}" placeholder="Assunto">
    </div>
    <div class=" col-auto">
        <button type="submit" class="btn btn-success">Buscar</button>
    </div>
</div>