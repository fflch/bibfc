<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Responsabilidade;
use App\Models\LivroResponsabilidade;

class LivroResponsabilidadeController extends Controller
{
    public function destroy(LivroResponsabilidade $pivot)
    {
        $this->authorize('admin');
        $livro_id = $pivot->livro_id;
        $pivot->delete();
        return redirect("/livros/{$livro_id}");
    }
}
