<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TccRequest;
use Illuminate\Support\Facades\Storage;

use App\Models\Tcc;
use App\Models\File;

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

        if($request->file) {
            $file = new File;
            $file->tcc_id = $tcc->id;
            $file->original_name = $request->file('file')->getClientOriginalName();
            $file->path = $request->file('file')->store('.');
            $file->save();
        }

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

        if($request->file) {
            // deletando arquivos anteriores
            foreach($tcc->files as $file) {
                Storage::move($file->path, $file->path . '_deletado_' . 'tcc_' . $tcc->id . '.pdf');
                $file->delete();
            }

            $file = new File;
            $file->tcc_id = $tcc->id;
            $file->original_name = $request->file('file')->getClientOriginalName();
            $file->path = $request->file('file')->store('.');
            $file->save();
        }

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

        // deletando arquivos - renomando
        foreach($tcc->files as $file) {
            Storage::move($file->path, $file->path . '_deletado_' . 'tcc_' . $tcc->id . '.pdf');
            $file->delete();
        }

        $titulo = $tcc->titulo; 
        $tcc->delete();
        $request->session()->flash('alert-danger','TCC deletado: ' . $titulo);
        return redirect('/tccs');
    }
}
