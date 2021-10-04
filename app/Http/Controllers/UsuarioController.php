<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuarios.index',[
            'usuarios' => Usuario::paginate(20)
        ]);
    }

    public function create()
    {
        return view('usuarios.create')->with('usuario',new Usuario);
    }

    public function store(UsuarioRequest $request)
    {
        //$this->authorize('admin');
        Usuario::create($request->validated());
        return redirect('/usuarios');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show')->with('usuario',$usuario);
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit')->with('usuario',$usuario);
    }

    public function update(UsuarioRequest $request, Usuario $usuario)
    {
        $validated = $request->validated();
        $usuario->update($validated);
        return redirect("usuarios");
    }

    public function destroy(Usuario $usuario)
    {
        //$this->authorize('admin');
        $usuario->delete();
        return redirect('/usuarios');
    }
}
