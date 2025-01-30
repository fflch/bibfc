<b> Livro </b>: {{ $livro->titulo }}

<br><br>

<div class="form-group">

    <div class="form-row">

        <div class="form-group col-md font-weight-bold">
            <label for="tombo">Tombo</label>
            <input type="number" id="tombo" class="form-control" name="tombo" value="{{ old('tombo', $instance->tombo) }}">
        </div>
        <div class="form-group col-md font-weight-bold">
            <label for="unidade">Unidade</label>
            <select name="unidade_id" id="unidade" class="form-control">
                <option value="" selected=""> - Selecione - </option>

                @foreach ($unidades as $unidade)
                    {{-- 1. Situação em que não houve tentativa de submissão --}}
                    @if (old('unidade') == '')
                    <option value="{{$unidade->id}}" {{ ( $unidades == $unidade) ? 'selected' : ''}}>
                        {{$unidade->nome_unidade}} - {{$unidade->localizacao_unidade}}
                    </option>

                    {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                    @else
                        <option value="{{$unidade->id}}" {{ ( old('unidade') == $unidade) ? 'selected' : ''}}>
                            {{$unidade->nome_unidade}} - {{$unidade->localizacao_unidade}}
                        </option>
                    @endif

                @endforeach
            </select>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md font-weight-bold">
            <label for="exemplar">Exemplar</label>
            <input type="number" class="form-control" name="exemplar" value="{{ old('exemplar', $instance->exemplar) }}">
        </div>

        <div class="form-group col-md font-weight-bold">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="" selected> - Selecione - </option>
                @foreach ($instance->status_list as $status)
                {{ ( $instance->status == $status ) ? 'selected' : ''}}

                    {{-- 1. Situação em que não houve tentativa de submissão --}}
                    @if (old('status') == '')
                        <option value="{{$status}}" {{ ( $instance->status == $status ) ? 'selected' : ''}}>
                            {{$status}}
                        </option>

                    {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                    @else
                        <option value="{{$status}}" {{ ( old('status') == $status) ? 'selected' : ''}}>
                            {{$status}}
                        </option>
                    @endif

                @endforeach
            </select>
        </div>
    </div>

    <input name="livro_id" type="hidden" value=" {{ $livro->id }} ">

    <div class="row">
        <div class="form-group col-md">
            <label for="obs">Notas</label>
            <textarea class="form-control" name="notas" rows="5">{{ old('notas', $instance->notas) }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Salvar</button> 
        </div> 
    </div>

</div>
