<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Proner\PhpPimaco\Tag;
use Proner\PhpPimaco\Pimaco;
use Proner\PhpPimaco\Tags\Barcode;

use App\Models\Instance;
use App\Models\Livro;
use App\Models\Usuario;
use App\Models\Emprestimo;
use Carbon\Carbon;

class BarcodeController extends Controller
{
    public function step1(){
        $this->authorize('admin');
        return view('barcode.step1');
    }

    public function step2(Request $request){
        $this->authorize('admin');

        $instances = [];
        $livros = Livro::where('localizacao','LIKE',$request->localizacao . '%')->pluck('id');
        $instances = Instance::whereIn('livro_id',$livros->toArray())->get();

        return view('barcode.step3',[
            'instances' => $instances,
        ]);
    }

    public function step4(Request $request){

        $this->authorize('admin');
        $pimaco = new Pimaco('A4363');

        $itens = Instance::findMany($request->instances);

        foreach($itens as $item){
            $tag = new Tag();
            $tag->setBorder(0);
            $tag->setSize(6);

            $tompo_composto = $item->tombo_tipo . ' - '. $item->tombo;

            $barcode = new Barcode((string)$tompo_composto, 'TYPE_CODE_128');
            $barcode->setAlign('right');
            $barcode->setWidth(1);

            $codigo = $barcode->render();
            $tag->p(view('barcode.etiqueta', [
                'codigo' => $codigo,
                'item'   => $item
            ]));
            $pimaco->addTag($tag);

        }
        $pimaco->output();
    }

    public function emprestar(){
        $this->authorize('admin');
        return view('barcode.emprestar');
    }

    public function emprestar_store(Request $request){
        $this->authorize('admin');

        // usuário
        $usuario = Usuario::where('matricula',$request->usuario)->first();
        
        // achando exemplar
        $barcode = explode(' - ', $request->barcode);
        $tombo_tipo = $barcode[0];
        $tombo = $barcode[1];
        $instance = Instance::where('tombo',$tombo)->where('tombo_tipo',$tombo_tipo)->first();

        # ficaria melhor se fizessemos essa checagem no EmprestimoRequest?
        if(!$instance){
            $request->session()->flash('alert-danger',"Livro não encontrado");
            return redirect('/barcode/emprestar');
        }

        # Verificamos se livro não está emprestado
        $emprestado = Emprestimo::where('instance_id',$instance->id)->where('data_devolucao',null)->first();             
        if($emprestado){
            $request->session()->flash('alert-danger',"Não foi possível realizar o empréstimo! <br>" .
            "O Livro {$emprestado->instance->livro->titulo} está emprestado para {$emprestado->usuario->nome}");
            return redirect('/barcode/emprestar');
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
        
        return redirect('/barcode/emprestar');

    }
}
