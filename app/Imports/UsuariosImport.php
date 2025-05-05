<?php

namespace App\Imports;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Schema;

class UsuariosImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $campos = array_slice(Schema::getColumnListing('usuarios'), 3);
        $atributos = [];
        foreach($campos as $key => $campo){
            $atributos[$campo] = $row[$key] ?? Auth::user()->unidade_id; //caso não haja ID da unidade no excel será setado automaticamente
        }
            return new Usuario($atributos);
    }

    //pula o número de linhas desejadas (ajuda caso tenha cabeçalho, por ex.)
    public function startRow(): int 
    {
        return 1;
    }
}
