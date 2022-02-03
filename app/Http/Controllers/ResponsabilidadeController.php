<?php

namespace App\Http\Controllers;

use App\Models\Responsabilidade;
use Illuminate\Http\Request;
use App\Http\Requests\ResponsabilidadeRequest;

class ResponsabilidadeController extends Controller
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
            $responsabilidades = Responsabilidade::where('nome','LIKE',"%{$request->search}%")
                        ->paginate(20);
        } else {
            $responsabilidades = Responsabilidade::paginate(20);
        }
        
        return view('responsabilidades.index',[
            'responsabilidades' => $responsabilidades,
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
        return view('responsabilidades.create',[
            'responsabilidade' => new Responsabilidade
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResponsabilidadeRequest $request)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        Responsabilidade::create($validated);

        return redirect("/responsabilidades");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Responsabilidade  $responsabilidade
     * @return \Illuminate\Http\Response
     */
    public function show(Responsabilidade $responsabilidade)
    {
        $this->authorize('admin');
        return view('responsabilidades.show',[
            'responsabilidade' => $responsabilidade,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Responsabilidade  $responsabilidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Responsabilidade $responsabilidade)
    {
        $this->authorize('admin');
        return view('responsabilidades.edit')->with([
            'responsabilidade' => $responsabilidade
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Responsabilidade  $responsabilidade
     * @return \Illuminate\Http\Response
     */
    public function update(ResponsabilidadeRequest $request, Responsabilidade $responsabilidade)
    {
        $this->authorize('admin');
        $validated = $request->validated();
        $responsabilidade->update($validated);

        return redirect("/responsabilidades");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Responsabilidade  $responsabilidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Responsabilidade $responsabilidade)
    {
        $this->authorize('admin');

        $livros = $responsabilidade->livros()->get();

        if($livros->isNotEmpty()){
            $mensagem = 'Operação não realizada. Os seguintes livros usam essa Responsabilidade: ';
            foreach($livros as $livro){
                $mensagem .= " <br> {$livro->titulo}";
            }
            $request->session()->flash('alert-danger',$mensagem);
            return redirect('/responsabilidades');
        }

        $responsabilidade->delete();
        return redirect('/responsabilidades');
    }
}
