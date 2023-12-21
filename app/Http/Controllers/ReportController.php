<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Emprestimo;
use App\Models\Instance;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request){
        $this->authorize('reports');

        $totais = DB::table('instances')
            ->where('status','Ativo')
            ->select(DB::raw('count(*) as num'),'tombo_tipo')
            ->groupBy('tombo_tipo')
            ->get();


        # buscas na localização
        $start_with_result = 0;
        $livros_start_with = Livro::where('localizacao','LIKE',$request->start_with . '%')->get();
        foreach($livros_start_with as $i){
            $start_with_result+= $i->instances->where('status','Ativo')->count();
        }

        $years = range(2021, date('Y'));
        $livros_by_year = [];
        foreach($years as $year){
            $livros_by_year[$year] = Livro::whereYear('created_at', $year)->count();
        }

        $exemplares = [];
        foreach($years as $year){
            $exemplares[$year] = Instance::whereYear('created_at', $year)->count();
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

        $top20_livros = [];
        foreach($years as $year){
            $array = Emprestimo::whereYear('emprestimos.created_at', $year)
                ->join('instances', 'instances.id', '=', 'emprestimos.instance_id')
                ->join('livros', 'livros.id', '=', 'instances.livro_id')
                ->pluck('livros.id')->toArray();


            $count = array_count_values(array_filter($array));
            arsort($count);
            $top20_livros[$year] = array_slice($count,0,20,true);
        }

        $top20_usuarios = [];
        foreach($years as $year){
            $array = Emprestimo::whereYear('emprestimos.created_at', $year)
                ->join('usuarios', 'usuarios.id', '=', 'emprestimos.usuario_id')
                ->pluck('usuarios.id')->toArray();


            $count = array_count_values(array_filter($array));
            arsort($count);
            $top20_usuarios[$year] = array_slice($count,0,20,true);
        }

        return view('reports.index',[
            'start_with_result' => $start_with_result,
            'years'   => $years,
            'livros_by_year' => $livros_by_year,
            'exemplares' => $exemplares,
            'emprestimos_by_year' => $emprestimos_by_year,
            'users_emprestimos_by_year' => $users_emprestimos_by_year,
            'users_emprestimos_by_year_grouped' => $users_emprestimos_by_year_grouped,
            'top20_livros' => $top20_livros,
            'top20_usuarios' => $top20_usuarios,
            'totais' => $totais
        ]);
    }
}
