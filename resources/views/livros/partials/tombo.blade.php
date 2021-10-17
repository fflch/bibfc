<div class="form-group col-md font-weight-bold">
    <label for="tombo">Tombo</label>
    <input type="number" id="tombo" class="form-control" name="tombo" value="{{ old('tombo', $livro->tombo) }}">
</div>

<div class="form-group col-md font-weight-bold">
    <label for="tombo_tipo">Tipo do Tombo</label>
    <select name="tombo_tipo" id="tombo_tipo" class="form-control">
        <option value="" selected=""> - Selecione - </option>
        @foreach ($livro->tombo_tipos as $tombo_tipo)
            {{-- 1. Situação em que não houve tentativa de submissão --}}
            @if (old('tombo_tipo') == '')
            <option value="{{$tombo_tipo}}" {{ ( $livro->tombo_tipo == $tombo_tipo) ? 'selected' : ''}}>
                {{$tombo_tipo}}
            </option>
            {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
            @else
                <option value="{{$tombo_tipo}}" {{ ( old('tombo_tipo') == $tombo_tipo) ? 'selected' : ''}}>
                    {{$tombo_tipo}}
                </option>
            @endif
        @endforeach
    </select>

</div>