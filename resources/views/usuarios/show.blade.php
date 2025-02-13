@extends('main')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm">
                <br>
            </div>

            <div class="col-auto float-right">
                <a href="/usuarios/{{$usuario->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
            </div>

            <div class="col-auto pull-right">
                <form method="POST" action="/usuarios/{{ $usuario->id }}">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i> Apagar</button>
                </form>
            </div>
        </div>
    </div>
    
    @if($usuario->tem_foto())
        <img src="/foto/{{ $usuario->matricula }}" width="150px">
    @else 
        <i class="fas fa-user-tie fa-5x"></i>
    @endif
<ul>
    @foreach(array_slice(\Illuminate\Support\Facades\Schema::getColumnListing('usuarios'), 3, -2) as $campos)
        <li><b>{{ucfirst($campos)}}</b>: {{$usuario->$campos ?? 'N/A'}}</li>
    @endforeach
        <li><b>Status</b>: {{$usuario->status == 1 ? 'Ativo' : 'Desativado'}}</li>
</ul>

@include('usuarios.partials.emprestimos',[
    'emprestimos' => $usuario->emprestimos
]) 

@endsection('content')
