<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\LivroResponsabilidade;
use App\Models\Responsabilidade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

//use App\Http\Requests\ResponsabilidadeRequest;

class HomeController extends Controller
{
    public function index(Request $request, Livro $livros)
    {
        //Fazendo group by para não repetir registros
        $query = LivroResponsabilidade::join('responsabilidades', 'responsabilidades.id', '=', 'responsabilidade_id')
        ->join('livros', 'livros.id', '=', 'livro_id')
        ->select(
            'livros.titulo',
            'livros.subtitulo',
            'livros.isbn',
            DB::raw("GROUP_CONCAT(responsabilidades.nome SEPARATOR ', ') as responsabilidades")
        )
        ->join('instances','livros.id','instances.livro_id')
        ->where('livros.status', 1)
        ->where('livro_responsabilidade.id','<>',null)
        ->groupBy('livros.id', 'livros.titulo', 'livros.subtitulo', 'livros.isbn');
    $query->when($request->busca, function ($query) use ($request) {
        $query->where('livros.titulo','like','%'.$request->busca.'%')
            ->orWhere('livros.subtitulo','like','%'.$request->busca.'%')
            ->orWhere('livros.isbn', $request->busca)
            ->orWhere('responsabilidades.nome','like','%'.$request->busca.'%');
    });
    
    return view('index')->with([
        'livros' => $query->paginate(15),
        'count' => $query->count(),
    ]);
    }
}
