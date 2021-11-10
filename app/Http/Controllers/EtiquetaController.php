<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Livro;
use Picqer\Barcode\BarcodeGeneratorHTML;

use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function etiquetas(){
        $this->authorize('admin');
        $livros = Livro::inRandomOrder()->limit(100)->get();
        $generator = new BarcodeGeneratorHTML();

        $pdf = PDF::loadView('etiquetas', [
            'livros'    => $livros,
            'generator' => $generator
        ]);

        # conversão de cm para points: divide a medida em centimetro 
        # por 2.54 e multiplica por 72
        $customPaper = array(0,0, (19.2/2.54)*72 , (340/2.54)*72 );
    

        #return $pdf->setPaper($customPaper)->download("etiquetas.pdf");
        return $pdf->download("etiquetas.pdf");
    }
}
