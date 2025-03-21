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

    public function tombo(){
        $this->authorize('admin');
        return view('barcode.tombo');
    }

    public function tombo_store(Request $request){
        $this->authorize('admin');

        $tombos = explode(',',$request->tombos);
        $tombos = array_map('trim', $tombos);

        $instances = Instance::whereIn('tombo',$tombos)
        ->get();

        return view('barcode.step3',[
            'instances' => $instances,
        ]);
    }

    public function step4(Request $request){
        $this->authorize('admin');
        $itens = Instance::findMany($request->instances);
        $pimaco = new Pimaco('A4363');
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


}
