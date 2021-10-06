<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->search) & !empty($request->search)) {
            $usuarios = Usuario::where('nome','LIKE',"%{$request->search}%")
                    ->orWhere('matricula','LIKE',"%{$request->search}%")
                    ->paginate(20);
        } else {
            $usuarios = Usuario::paginate(20);
        }

        return view('usuarios.index',[
            'usuarios' => $usuarios
        ]);
    }

    public function create()
    {
        return view('usuarios.create')->with('usuario',new Usuario);
    }

    public function store(UsuarioRequest $request)
    {
        //$this->authorize('admin');
        $validated = $request->validated();

        if($validated['foto'] != null) {
            $image = str_replace('data:image/png;base64,', '', $validated['foto']);
            $image = str_replace(' ', '+', $image);
            $imageName = $validated['matricula']. '.png';
            Storage::put($imageName, base64_decode($image));
        }

        Usuario::create($validated);
        return redirect('/usuarios');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show')->with('usuario',$usuario);
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit',[
            'usuario' => $usuario,
        ]);
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $validated = $request->validated();

        if($validated['foto'] != null) {
            $image = str_replace('data:image/png;base64,', '', $validated['foto']);
            $image = str_replace(' ', '+', $image);
            $imageName = $validated['matricula']. '.png';
            Storage::put($imageName, base64_decode($image));
        }

        $usuario->update($validated);

        return redirect("usuarios");
    }

    public function foto($matricula)
    {
        return Storage::download($matricula . '.png');   
    }

    public function destroy(Usuario $usuario)
    {
        //$this->authorize('admin');
        $usuario->delete();
        return redirect('/usuarios');
    }

}
