<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\LivroResponsabilidade;
use App\Models\Responsabilidade;
use Illuminate\Support\Facades\Gate;

//use App\Http\Requests\ResponsabilidadeRequest;

class HomeController extends Controller
{
    public function index(Request $request, Livro $livros)
    {

        $query = LivroResponsabilidade::join('responsabilidades','responsabilidades.id','responsabilidade_id')
        ->join('livros','livros.id','livro_id')
        ->select('responsabilidades.nome','livros.titulo','livros.subtitulo','livros.isbn')
        ->where('status',1)
        ->toBase();

        $query->when($request->busca, function ($query) use ($request) {
            $query->where('livros.titulo','like','%'.$request->busca.'%')
                ->orwhere('livros.subtitulo','like','%'.$request->busca.'%')
                ->orwhere('livros.isbn',$request->busca)
                ->orwhere('responsabilidades.nome','like','%'.$request->busca.'%');
    });
        //return view('index')->with(['livros' => $query->paginate(15)]);
        return view('index')->with([
            'livros' => $query->paginate(15),
            'count' => $query->count(),
        ]);
    }
}
