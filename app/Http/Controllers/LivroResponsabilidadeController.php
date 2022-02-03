<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Responsabilidade;
use App\Models\LivroResponsabilidade;
use Illuminate\Validation\Rule;

class LivroResponsabilidadeController extends Controller
{
    public function create(Livro $livro)
    {
        $this->authorize('admin');
        return view('livros.responsabilidade',[
            'livro' => $livro,
            'responsabilidades' => Responsabilidade::all(),
            'tipos'             => LivroResponsabilidade::tipos,
        ]);
    }

    public function store(Request $request, Livro $livro)
    {
        $this->authorize('admin');

        $request->validate([
            'responsabilidade_id' => ['required','integer', Rule::in(Responsabilidade::pluck('id')->toArray())],
            'tipo' => ['required', Rule::in(LivroResponsabilidade::tipos)],
        ]);
        
        $livro->responsabilidades()->attach($request->responsabilidade_id,[
            'tipo' => $request->tipo,
        ]);
        $livro->save();

        return redirect("/livros/{$livro->id}");
    }

    public function destroy(LivroResponsabilidade $pivot)
    {
        $this->authorize('admin');
        $livro_id = $pivot->livro_id;
        $pivot->delete();
        return redirect("/livros/{$livro_id}");
    }
}
