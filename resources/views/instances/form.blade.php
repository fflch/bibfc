<div class="form-row">
    @include('livros.partials.tombo')
</div>

<div class="form-group col-lg-1 font-weight-bold">
    <label for="exemplar">Exemplar</label>
    <input type="number" class="form-control" name="exemplar" value="{{ old('exemplar', $livro->exemplar) }}">
</div>