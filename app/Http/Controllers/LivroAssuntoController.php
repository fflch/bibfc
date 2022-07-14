<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Assunto;
use App\Models\LivroAssunto;
use Illuminate\Validation\Rule;

class LivroAssuntoController extends Controller
{
    public function create(Livro $livro)
    {
        $this->authorize('admin');
        return view('livros.assunto',[
            'livro' => $livro,
            'assuntos' => Assunto::all()
        ]);
    }

    public function store(Request $request, Livro $livro)
    {
        $this->authorize('admin');

        $request->validate([
            'assunto_id' => ['required','integer', Rule::in(Assunto::pluck('id')->toArray())]
        ]);
        
        $livro->assuntos()->attach($request->assunto_id);
        $livro->save();

        return redirect("/livros/{$livro->id}");
    }

    public function destroy(LivroAssunto $pivot)
    {
        $this->authorize('admin');
        $livro_id = $pivot->livro_id;
        $pivot->delete();
        return redirect("/livros/{$livro_id}");
    }
}
