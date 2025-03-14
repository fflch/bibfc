<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoRequest;
use App\Models\Livro;
use App\Models\Instance;
use App\Models\User;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmprestimoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');
        
        $emprestimos = Emprestimo::whereNull('data_devolucao')
            ->whereHas('instance', function($query) {
                $query->where('instances.status', '=', 'CIRCULA');
                $query->join('usuarios','usuario_id','usuarios.id')
                ->where('usuarios.unidade_id',Auth::user()->unidade_id);
            })
            ->get();

        return view('emprestimos.index',[
            'emprestimos' => $emprestimos,
            'emprestimos_finalizados' => Emprestimo::whereNotNull('data_devolucao')->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');

        $instances = Instance::where('unidade_id',auth()->user()->unidade_id)->get();
         
        return view('emprestimos.create')->with([
            'emprestimo' => New Emprestimo,
            'usuarios'  => Usuario::where('unidade_id',auth()->user()->unidade_id)->get(),
            'instances' => $instances
        ]);
    }

    /**
     * Método que realiza empréstimo
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmprestimoRequest $request)
    {
        $this->authorize('admin');

        $instance = Instance::where('id',trim($request->instance_id))->first();
        $usuario = Usuario::where('matricula',$request->usuario)->first();

        # ficaria melhor se fizessemos essa checagem no EmprestimoRequest?
        if(!$instance){
            $request->session()->flash('alert-danger',"Livro não encontrado");
            return redirect('/emprestimos/create');
        }

        # Verificamos se livro não está emprestado
        $emprestado = Emprestimo::where('instance_id',$instance->id)->where('data_devolucao',null)->first();             
        if($emprestado){
            $request->session()->flash('alert-danger',"Não foi possível realizar o empréstimo! <br>" .
            "O Livro {$emprestado->instance->livro->titulo} está emprestado para {$emprestado->usuario->nome}");
            return redirect('/emprestimos/create');
        }

        # Registrando empréstimo
        $emprestimo = new Emprestimo;
        $emprestimo->data_emprestimo = Carbon::now()->toDateString();
        $emprestimo->usuario_id =  $usuario->id;
        $emprestimo->user_id = auth()->user()->id;
        $emprestimo->instance_id = $instance->id;
        $emprestimo->obs = $request->obs;
        $emprestimo->save();
        $request->session()->flash('alert-info',
            "Livro <b>{$instance->livro->titulo}</b> emprestado para <b>{$usuario->nome}</b>.<br>
            Data de devolução {$emprestimo->prazo}" );

        return redirect('/emprestimos/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function show(Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        return view('emprestimos.show')->with([
            'emprestimo' => $emprestimo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function edit(Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        return view('emprestimos.edit')->with([
            'emprestimo' => $emprestimo
        ]);
    }

    /**
     * Usando o método update para devolução
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        $emprestimo->data_devolucao = Carbon::now();
        $emprestimo->obs = $request->obs;
        $emprestimo->save();

        $request->session()->flash('alert-info',"Livro devolvido" );
        return redirect('/emprestimos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        $emprestimo->delete();
        return redirect('/');
    }

    public function renovarForm(Emprestimo $emprestimo)
    {
        $this->authorize('admin');
        $emprestimos = Emprestimo::where('usuario_id',$emprestimo->usuario_id)
                                 ->where('data_devolucao',null)
                                 ->where('instance_id',"!=",$emprestimo->instance_id)
                                 ->get();

        return view('emprestimos.renovar')->with([
            'emprestimo' => $emprestimo,
            'emprestimos' => $emprestimos
        ]);
    }

    public function renovar(Request $request, Emprestimo $emprestimo)
    {
        $this->authorize('admin');
       
        $emprestimo->renew +=1;
        $emprestimo->obs = $request->obs;
        $emprestimo->save();

        $request->session()->flash('alert-info',"Livro {$emprestimo->instance->livro->nome} renovado!");

        return redirect('/emprestimos');
    }

    public function json_emprestimos_ativos($matricula) {
        $usuario = Usuario::where('matricula',$matricula)->first();
        $this->authorize('admin');
        $emprestimos = Emprestimo::where('usuario_id',$usuario->id)
                                  ->where('data_devolucao',null)
                                  ->get();

        $emprestimos_json = [];
        foreach($emprestimos as $emprestimo){
            $emprestimos_json[] = [
                'titulo' => $emprestimo->instance->livro->titulo,
                'tombo' => $emprestimo->instance->tombo,
                'tombo_tipo' => $emprestimo->instance->tombo_tipo,
            ];
        }

        return response()->json($emprestimos_json); 
    }
}
