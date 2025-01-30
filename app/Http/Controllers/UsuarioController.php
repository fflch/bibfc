<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');
        if(isset($request->search) & !empty($request->search)) {
            $usuarios = Usuario::where('unidade_id',auth()->user()->unidade_id)
                    ->where('nome','LIKE',"%{$request->search}%")
                    ->orWhere('matricula','LIKE',"%{$request->search}%")
                    ->paginate(20);
        } else {
            $usuarios = Usuario::where('unidade_id',auth()->user()->unidade_id)->paginate(20);
        }

        return view('usuarios.index',[
            'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        $this->authorize('admin');
        return view('usuarios.create')->with('usuario',new Usuario);
    }

    public function store(UsuarioRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $validated['unidade_id'] = auth()->user()->unidade_id;
        if($validated['foto'] != null) {
            $image = str_replace('data:image/png;base64,', '', $validated['foto']);
            $image = str_replace(' ', '+', $image);
            $imageName = $validated['matricula']. '.jpg';
            Storage::put($imageName, base64_decode($image));
        }

        Usuario::create($validated);
        return redirect('/usuarios');
    }

    public function show(Usuario $usuario)
    {
        Gate::authorize('admin_unidade',$usuario);
        return view('usuarios.show')->with('usuario',$usuario);
    }

    public function edit(Usuario $usuario)
    {
        Gate::authorize('admin_unidade', $usuario);
        return view('usuarios.edit',[
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        Gate::authorize('admin_unidade', $usuario);
        $validated = $request->validated();

        if($validated['foto'] != null) {
            $image = str_replace('data:image/png;base64,', '', $validated['foto']);
            $image = str_replace(' ', '+', $image);
            $imageName = $validated['matricula']. '.jpg';
            Storage::put($imageName, base64_decode($image));
        }

        $usuario->update($validated);

        return redirect("usuarios");
    }

    public function foto($matricula)
    {
        $this->authorize('admin');
        return Storage::download($matricula . '.jpg');   
    }

    public function temfoto($matricula)
    {
        $this->authorize('admin');
        $usuario = Usuario::where('matricula',$matricula)->first();
        if($usuario) return $usuario->tem_foto();
        return false;
    }

    public function destroy(Usuario $usuario)
    {
        $this->authorize('admin');
        request()->session()->flash('alert-danger','Usuário deletado: ' . $usuario->nome . ' - ' . $usuario->matricula);
        $usuario->delete();
        return redirect('/usuarios');
    }
}
