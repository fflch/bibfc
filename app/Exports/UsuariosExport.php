<?php

namespace App\Exports;

use App\Models\Usuario;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Schema;

class UsuariosExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $headings = Usuario::camposTabela();
        return Usuario::select($headings)->where('unidade_id',auth()->user()->unidade_id)->get();
    }

}
