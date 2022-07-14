<?php

namespace App\Http\Controllers;

use App\Models\Assunto;
use Illuminate\Http\Request;
use App\Http\Requests\AssuntoRequest;

class AssuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');
        if(isset($request->search) & !empty($request->search)) {
            $assuntos = Assunto::where('titulo','LIKE',"%{$request->search}%")->get();
        } else {
            $assuntos = Assunto::whereNull('parent_id')->get();
        }
        
        return view('assuntos.index',[
            'assuntos' => $assuntos,
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
        $assuntos = Assunto::orderBy('titulo', 'asc')->get();

        return view('assuntos.create',[
            'assunto'  => new Assunto,
            'assuntos' => $assuntos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssuntoRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        Assunto::create($validated);

        return redirect("/assuntos");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assunto  $Assunto
     * @return \Illuminate\Http\Response
     */
    public function show(Assunto $assunto)
    {
        $this->authorize('admin');
        return view('assuntos.show',[
            'assunto' => $assunto,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assunto  $Assunto
     * @return \Illuminate\Http\Response
     */
    public function edit(Assunto $assunto)
    {
        $this->authorize('admin');
        $assuntos = Assunto::orderBy('titulo', 'asc')->get();
        return view('assuntos.edit')->with([
            'assunto' => $assunto,
            'assuntos' => $assuntos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assunto  $Assunto
     * @return \Illuminate\Http\Response
     */
    public function update(AssuntoRequest $request, Assunto $assunto)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $assunto->update($validated);

        return redirect("/assuntos");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assunto  $Assunto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Assunto $assunto)
    {
        $this->authorize('admin');

        $assuntos = $assunto->children()->get();

        if($assuntos->isNotEmpty()){
            $request->session()->flash('alert-danger', "<b>$assunto->titulo</b>".' não pode ser deletado porque contém termos específicos');
            return redirect('/assuntos');
        }

        $assunto->delete();
        return redirect('/assuntos');
    }
}
