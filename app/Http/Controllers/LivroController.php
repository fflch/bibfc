<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LivroRequest;

use App\Models\Instance;
use App\Models\Emprestimo;
use App\Models\Livro;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Responsabilidade;
use App\Models\LivroResponsabilidade;
use App\Models\LivroAssunto;
use Illuminate\Support\Facades\Gate;

class LivroController extends Controller
{

    public function index(Request $request)
    {
        Gate::authorize('admin');
        $query = $this->prepareQuery($request);
        # Excluindo itens da pré-catalogação (sem exemplares)
        $query->whereHas('instances');
        
        return view('livros.index',[
            'livros' => $query->paginate(20),
        ]);
    }

    public function pre(Request $request){ //pré-catalogação
        $this->authorize('admin');

        $query = $this->prepareQuery($request);

        # Somente itens da pré-catalogação (sem exemplares)
        $query->whereDoesntHave('instances');

        return view('livros.pre',[
            'livros' => $query->get(),
        ]);
    }

    //aprova ou reprova o status de um registro na pré-catalogação
    public function status(Request $request, Livro $livro){
        $this->authorize('admin');
        $livro->status = $request->status;
        $livro->update();
        return redirect()->back();
    }

    /*
        Aprova todos os registros em pré-catalogação
    */
    public function aprovar_todos(Request $request){ 
        $this->authorize('admin');
        $livros = Livro::where('status', NULL)->get();
        foreach($livros as $livro){
            $livro->status = $request->status;
            $livro->update();
        }
        return redirect()->back();
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
            'livro' => new Livro,
            'livro_responsabilidade' => new Responsabilidade,
            'livro_assunto' => new LivroAssunto
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivroRequest $request, Livro $livro)
    {
        $this->authorize('admin');
        $livro = Livro::create($request->validated());
        foreach($request->tipo as $index => $row){
            $livro_responsabilidade = new LivroResponsabilidade;
            $livro_responsabilidade->livro_id = $livro->id;
            $livro_responsabilidade->tipo = $request->tipo[$index] ?? '-'; //impede erro por inserção nula no campo
            $livro_responsabilidade->responsabilidade_id = $request->responsabilidade[$index];
            $livro->livro_responsabilidades()->save($livro_responsabilidade);
        }
        foreach($request->assunto as $key => $row){
            $livro_assunto = new LivroAssunto;
            $livro_assunto->livro_id = $livro->id;
            $livro_assunto->assunto_id = $row;
            $livro->assuntos()->attach($row);
        }
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

        $livro_responsabilidade1 = optional( //evita erro caso não tenha autor
            LivroResponsabilidade::where('livro_id', $livro->id)->first()
        )->tipo;

        $livro_assunto = LivroAssunto::where('livro_id',$livro->id)->pluck('assunto_id')->toArray();

        return view('livros.edit')->with([
            'livro' => $livro,
            'livro_assunto' => $livro_assunto,
            'livro_responsabilidade1' => $livro_responsabilidade1
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
        $livro->update($request->validated());

        // Atualiza as responsabilidades (pode ser necessário apagar as antigas antes)
        $livro->livro_responsabilidades()->delete(); //apaga dados repetidos
        foreach ($request->input('tipo') as $index => $tipo) {
            //Pega os inputs com campos vazios e exclui, impedindo a sua inserção na DB
            $livro->livro_responsabilidades()->where('responsabilidade_id',NULL)->delete();
            $livro->livro_responsabilidades()->create([
                'tipo' => $tipo ?? '-',
                'responsabilidade_id' => $request->input('responsabilidade')[$index] ?? NULL
            ]);
        }
        $livro->livro_assuntos()->delete(); //exclui as existentes para evitar repetição
        $array = array_map(fn($row) => [
            'livro_id' => $livro->id,
            'assunto_id' => $row
        ],$request->assunto);
        LivroAssunto::upsert($array, ['livro_id','assunto_id']);
        return redirect("/livros/{$livro->id}");
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

    private function prepareQuery(Request $request){
        $query = Livro::orderBy('localizacao');

        if(isset($request->titulo) & !empty($request->titulo)) {
            $query->where('titulo','LIKE',"%{$request->titulo}%");
        } 
        
        if(isset($request->localizacao) & !empty($request->localizacao)) {
            $query->where('localizacao','LIKE',"%{$request->localizacao}%");
        } 

        if(isset($request->tombo) & !empty($request->tombo)) {
            $query->whereHas('instances', function (Builder $q) use ($request) {
                $q->where('tombo',$request->tombo);
            });
        }

        if(isset($request->responsabilidade) & !empty($request->responsabilidade)) {
            $query->whereHas('responsabilidades', function (Builder $q) use ($request) {
                $q->where('nome','LIKE',"%{$request->responsabilidade}%");
                #->orwhere('sobrenome','LIKE',"%{$request->responsabilidade}%");
            });
        }

        if(isset($request->assunto) & !empty($request->assunto)) {
            $query->whereHas('assuntos', function (Builder $q) use ($request) {
                $q->where('titulo','LIKE',"%{$request->assunto}%");
            });
        }
        
        return $query;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro, Request $request)
    {
        $this->authorize('admin');

        if($livro->instances->isNotEmpty()){
            $request->session()->flash('alert-danger','Livro não pode ser deletado porque contém exemplares!');
            return redirect('/livros/' . $livro->id );
        }
        $titulo = $livro->titulo; 
        $livro->delete();
        $request->session()->flash('alert-danger','Livro deletado: ' . $titulo);
        return redirect('/livros');
    }
}
