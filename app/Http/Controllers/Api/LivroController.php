<?php

namespace App\Http\Controllers\Api;

use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Requests\LivroRequest;
use App\Models\Record;
use App\Models\Emprestimo;
use App\Http\Controllers\Controller;

class LivroController extends Controller
{   
    # Rota pública
    public function show(Livro $livro)
    {
        return response()->json($livro);
    }
}
