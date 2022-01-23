<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use Illuminate\Http\Request;
use App\Http\Requests\LivroRequest;
use App\Models\Record;
use App\Models\Emprestimo;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');
        if(isset($request->search) & !empty($request->search)) {
            $livros = Livro::where('titulo','LIKE',"%{$request->search}%")
                    ->orWhere('autor','LIKE',"%{$request->search}%")
                    ->orWhere('tombo','LIKE',"%{$request->search}%")
                    ->orWhere('localizacao','LIKE',"%{$request->search}%")
                    ->paginate(20);
        } else {
            $livros = Livro::paginate(20);
        }

        $totais = DB::table('livros')
                ->select(DB::raw('count(*) as num'),'tombo_tipo')
                ->groupBy('tombo_tipo')
                ->get();

        return view('livros.index',[
            'livros' => $livros,
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
        Livro::create($validated);

        return redirect("/livros");
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

        return redirect("/livros");
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

}
