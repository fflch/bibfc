<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Emprestimo;

class ReportController extends Controller
{
    public function index(){
        $this->authorize('reports');

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

        // por enquanto só usamos o ano corrente, verificar um jeito de guardar o histórico das turmas
        $users_emprestimos_by_year_grouped = [];
        foreach($years as $year){
            $array = Emprestimo::whereYear('emprestimos.created_at', $year)
                ->join('usuarios', 'usuarios.id', '=', 'emprestimos.usuario_id')
                ->pluck('usuarios.turma')->toArray();

                $count = array_count_values(array_filter($array));
                arsort($count);
                $users_emprestimos_by_year_grouped[$year] = $count;
        }

        $top10_livros = [];
        foreach($years as $year){
            $array = Emprestimo::whereYear('emprestimos.created_at', $year)
                ->join('instances', 'instances.id', '=', 'emprestimos.instance_id')
                ->join('livros', 'livros.id', '=', 'instances.livro_id')
                ->pluck('livros.id')->toArray();


            $count = array_count_values(array_filter($array));
            arsort($count);
            $top10_livros[$year] = array_slice($count,0,10,true);
        }

        return view('reports.index',[
            'i_start' => $i_start,
            'years'   => $years,
            'livros_by_year' => $livros_by_year,
            'emprestimos_by_year' => $emprestimos_by_year,
            'users_emprestimos_by_year' => $users_emprestimos_by_year,
            'users_emprestimos_by_year_grouped' => $users_emprestimos_by_year_grouped,
            'top10_livros' => $top10_livros
        ]);
    }
}
