<div class="form-group">

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="titulo">Assunto</label>
            <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $assunto->titulo) }}">
        </div>
    </div>

    <div class="form-row">
        <label for="parent_id" class="required">Assunto geral</label>
        <select name="parent_id" class="form-control" id="parent_id">

        <option value="" selected="">- Selecione -</option>
        @foreach ($assuntos as $parent)

            {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
            @if (old('parent_id') == '' and isset($assunto->parent_id))
            <option value="{{$parent->id}}" {{ ( $assunto->parent_id == $parent->id) ? 'selected' : ''}}>
                {{ $parent->titulo }}
            </option>
            {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
            @else
            <option value="{{$parent->id}}" {{ ( old('parent_id') == $parent->id) ? 'selected' : ''}}>
                {{ $parent->titulo }}
            </option>
            @endif

        @endforeach
        </select>
    </div>
    <br>
    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button> 
        </div> 
    </div>

</div>
