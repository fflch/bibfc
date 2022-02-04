<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LivroRequest;

use App\Models\Instance;
use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');

        $query = Livro::orderBy('titulo', 'desc');

        if(isset($request->titulo) & !empty($request->titulo)) {
            $livros = $query->where('titulo','LIKE',"%{$request->titulo}%");
        } 
        
        if(isset($request->localizacao) & !empty($request->localizacao)) {
            $livros = $query->where('localizacao','LIKE',"%{$request->localizacao}%");
        } 

        if(isset($request->tombo) & !empty($request->tombo)) {
            $livros = $query->whereHas('instances', function (Builder $q) use ($request) {
                $q->where('tombo',$request->tombo);
            });
        }

        if(isset($request->responsabilidade) & !empty($request->responsabilidade)) {
            $livros = $query->whereHas('responsabilidades', function (Builder $q) use ($request) {
                $q->where('nome','LIKE',"%{$request->responsabilidade}%");
            });
        }

        $totais = DB::table('instances')
                ->select(DB::raw('count(*) as num'),'tombo_tipo')
                ->groupBy('tombo_tipo')
                ->get();
        
        return view('livros.index',[
            'livros' => $query->paginate(20),
            'totais' => $totais
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
        return view('livros.create',[
            'livro' => new Livro
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivroRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $livro = Livro::create($validated);

        // esse trecho não está bom, mas é um quebra galho por hora
        if($request->colorido == 'sim'){
            $livro->colorido = 'sim';
        } else {
            $livro->colorido = 'não';
        }

        if($request->ilustrado == 'sim'){
            $livro->ilustrado = 'sim';
        } else {
            $livro->ilustrado = 'não';
        }
        $livro->save();

        return redirect("/livros/{$livro->id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        $this->authorize('admin');
        return view('livros.show')->with([
            'livro' => $livro,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {
        $this->authorize('admin');
        return view('livros.edit')->with([
            'livro' => $livro
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(LivroRequest $request, Livro $livro)
    {
        
        $this->authorize('admin');
        $validated = $request->validated();
        $livro->update($validated);

        // esse trecho não está bom, mas é um quebra galho por hora
        if($request->colorido == 'sim'){
            $livro->colorido = 'sim';
        } else {
            $livro->colorido = 'não';
        }

        if($request->ilustrado == 'sim'){
            $livro->ilustrado = 'sim';
        } else {
            $livro->ilustrado = 'não';
        }
        $livro->save();

        return redirect("/livros/{$livro->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        $this->authorize('admin');
        $livro->delete();
        return redirect('/livros');
    }

    public function mesclar()
    {
        $this->authorize('admin');

        return view('livros.mesclar',[
            'grupos' => Livro::all()->groupBy('localizacao'),
        ]);
    }

    public function mesclarStore(Request $request)
    {
        $this->authorize('admin');
        
        $request->validate([
            'livros' => 'required',
        ]);

        $livros = Livro::whereIn('id',$request->livros)->get();

        # livro eleito como principal
        $eleito = $livros->pop();

        # movendo exemplares para eleito
        foreach($livros as $livro){
            $instances = $livro->instances;
            foreach($instances as $instance){
                $instance->livro_id = $eleito->id;
                $instance->save();
            }
            $livro->delete();
        }

        $request->session()->flash('alert-info',"Exemplares unificados com sucesso!" );
        return redirect("/livros/{$eleito->id}");
    }

    

}
