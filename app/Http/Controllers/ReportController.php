<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Emprestimo;

class ReportController extends Controller
{
    public function index(){
        $this->authorize('admin');

        $i_start = Livro::where('localizacao','LIKE','I%')->orWhere('localizacao','LIKE','i%')->count();

        $years = range(2021, date('Y'));

        $livros_by_year = [];
        foreach($years as $year){
            $livros_by_year[$year] = Livro::whereYear('created_at', $year)->count();
        }
        
        $emprestimos_by_year = [];
        foreach($years as $year){
            $emprestimos_by_year[$year] = Emprestimo::whereYear('created_at', $year)->count();
        }

        $users_emprestimos_by_year = [];
        foreach($years as $year){
            $users_emprestimos_by_year[$year] = Emprestimo::whereYear('created_at', $year)->distinct()->count('usuario_id');
        }

        $users_emprestimos_by_year_grouped = [];
        foreach($years as $year){
            $users_emprestimos_by_year_grouped[$year] = Emprestimo::whereYear('emprestimos.created_at', $year)
                ->join('usuarios', 'usuarios.id', '=', 'emprestimos.usuario_id')
                ->pluck('usuarios.turma')->toArray();
        }
        $array = $users_emprestimos_by_year_grouped[2022];
        //dd($array);

        return view('reports.index',[
            'i_start' => $i_start,
            'years'   => $years,
            'livros_by_year' => $livros_by_year,
            'emprestimos_by_year' => $emprestimos_by_year,
            'users_emprestimos_by_year' => $users_emprestimos_by_year
        ]);
    }
}
