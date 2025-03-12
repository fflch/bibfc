@include('usuarios.partials.foto')

<div class="row">
    <div class="col-sm">

        <div class="form-group">
            <label for="matricula"><b>Código da Matrícula</b></label>
            <input type="text" class="form-control" name="matricula" placeholder="" value="{{ old('matricula', $usuario->matricula) }}">   
        </div>

        <div class="form-group">
            <label for="nome"><b>Nome</b></label>
            <input type="text" class="form-control" name="nome" placeholder="" value="{{ old('nome', $usuario->nome) }}">   
        </div>

        <div class="form-group">
            <label for="telefone"><b>Quarto</b></label>
            <input type="text" class="form-control" name="quarto" placeholder="" value="{{ old('quarto', $usuario->quarto) }}">   
        </div>

        <div class="form-group">
            <label for="prontuario"><b>Prontuario</b></label>
            <input type="text" class="form-control" name="prontuario" placeholder="" value="{{ old('prontuario', $usuario->prontuario) }}">   
        </div>

        <div class="form-group">
            <label for="turma"><b>Sala</b></label>
            <input type="text" class="form-control" name="sala_de_aula" placeholder="" value="{{ old('sala_de_aula', $usuario->sala_de_aula) }}">   
        </div>

        <div class="form-group">
            <label for="turma"><b>Status</b></label>
            <select class="form-control" name="status">
            @foreach($usuario::statuses() as $key => $status)
            @if(old('status') == '' and $usuario->status)
            <option value="{{$key}}">{{$status}}</option>
            @else
            <option value="{{$key}}" {{  (old('status') == $key ? 'selected' : '') }}>{{ $status }}</option>
            @endif

            @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="obs">Observações sobre este usuário</label>
            <textarea class="form-control" name="obs" rows="3">{{ old('obs', $usuario->obs) }}</textarea>
        </div>

    </div>
    <div class="col-sm">
        <input id="foto" type="hidden" name="foto">
            <div class="contentarea">
                <div class="camera">
                    <video id="video">Video stream not available.</video>
                </div>
                <div><button id="startbutton">Tirar Foto</button></div>
                
                <canvas id="canvas"></canvas>
                <div class="output">
                    <img id="photo" alt="The screen capture will appear in this box."> 
                    @if($usuario->tem_foto())
                        <img id="foto_antiga" src="/foto/{{ $usuario->matricula }}"> 
                    @endif
                </div> 
            </div>
    </div>
</div>

<div class="row">
    <div class="form-group">
        <button type="submit" class="btn btn-success">Salvar</button> 
    </div> 
</div>


