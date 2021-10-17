<?php

namespace App\Http\Controllers;

use App\Models\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoRequest;
use App\Models\Livro;
use App\Models\User;
use App\Models\Usuario;
use Carbon\Carbon;

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
        $emprestimos = Emprestimo::where('data_devolucao',null)->get();
        return view('emprestimos.index',[
            'emprestimos' => $emprestimos
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
        $livros = Livro::all();
        $usuarios = Usuario::all();
        return view('emprestimos.create')->with([
            'emprestimo' => New Emprestimo,
            'livros'    => $livros,
            'usuarios'  => $usuarios
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

        $emprestimo = new Emprestimo;
        $emprestimo->data_emprestimo = Carbon::now()->toDateString();

        $usuario = Usuario::where('matricula',$request->usuario)->first();
        $emprestimo->usuario_id =  $usuario->id;
        
        $livro = Livro::where('tombo',trim($request->tombo))
                    ->where('tombo_tipo',trim($request->tombo_tipo))->first();
        // verificar se o livro em questão já está emprestado
       
        if($livro){
            $emprestado = Emprestimo::where('livro_id',$livro->id)->where('data_devolucao',null)->first();             
            if($emprestado){
                $request->session()->flash('alert-danger',"Não foi possível realizar o empréstimo! <br>" .
                "O Livro {$emprestado->livro->titulo} está emprestado para {$emprestado->usuario->nome}");
                return redirect('/emprestimos/create');
            }
        }

        if(!$livro) {
            $livro = new Livro();
        }
        $livro->titulo = $request->titulo;
        $livro->autor = $request->autor;
        $livro->tombo = $request->tombo;
        $livro->tombo_tipo = $request->tombo_tipo;
        $livro->save();
        
        $emprestimo->user_id = auth()->user()->id;
        $emprestimo->livro_id = $livro->id;
        $emprestimo->save();

        $request->session()->flash('alert-info',"Prazo de devolução {$emprestimo->prazo}" );
        return redirect('/emprestimos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Emprestimo  $emprestimo
     * @return \Illuminate\Http\Response
     */
    public function show(Emprestimo $emprestimo)
    {
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
        return view('emprestimos.renovar')->with([
            'emprestimo' => $emprestimo
        ]);
    }

    public function renovar(Request $request, Emprestimo $emprestimo)
    {
        $this->authorize('admin');

        $new = $emprestimo->replicate();
        
        $emprestimo->data_devolucao = Carbon::now();
        $emprestimo->save();

        $new->data_emprestimo = Carbon::now();
        $new->save();
        
        $request->session()->flash('alert-info',"Prazo de devolução {$new->prazo}" );
        return redirect('/emprestimos');

    }
}
