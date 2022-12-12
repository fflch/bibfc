<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TccRequest;

use App\Models\Tcc;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class TccController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');
        $query = Tcc::orderBy('localizacao');

        if(isset($request->titulo) & !empty($request->titulo)) {
            $query->where('titulo','LIKE',"%{$request->titulo}%");
        } 
        
        if(isset($request->localizacao) & !empty($request->localizacao)) {
            $query->where('localizacao','LIKE',"%{$request->localizacao}%");
        } 

        if(isset($request->autores) & !empty($request->autores)) {
            $query->where('autores','LIKE',"%{$request->autores}%");
        }

        if(isset($request->orientador) & !empty($request->orientador)) {
            $query->where('orientador','LIKE',"%{$request->orientador}%");
        }

        if(isset($request->ano) & !empty($request->ano)) {
            $query->where('ano','LIKE',"%{$request->ano}%");
        }
        
        return view('tccs.index',[
            'tccs' => $query->paginate(20),
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
        return view('tccs.create',[
            'tcc' => new Tcc
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TccRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $tcc = Tcc::create($validated);
        $tcc->save();

        return redirect("/tccs/{$tcc->id}");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Tcc $tcc)
    {
        $this->authorize('admin');
        return view('tccs.show', [
            'tcc' => $tcc,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Tcc $tcc)
    {
        $this->authorize('admin');
        return view('tccs.edit', [
            'tcc' => $tcc
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(TccRequest $request, Tcc $tcc)
    {
        
        $this->authorize('admin');
        $validated = $request->validated();
        $tcc->update($validated);
        $tcc->save();

        return redirect("/tccs/{$tcc->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tcc $tcc, Request $request)
    {
        $this->authorize('admin');

        // TODO: deletar arquivo
        $titulo = $tcc->titulo; 
        $tcc->delete();
        $request->session()->flash('alert-danger','TCC deletado: ' . $titulo);
        return redirect('/tccs');
    }
}
