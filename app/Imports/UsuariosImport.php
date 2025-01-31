<?php

namespace App\Imports;

use App\Models\Usuario;
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
            $atributos[$campo] = $row[$key] ?? auth()->user()->unidade_id; //caso não haja ID da unidade no excel será setado automaticamente
        }
            return new Usuario($atributos);
    }

    public function startRow(): int //pula o cabeçalho (1ª Linha). alterar em caso de erro
    {
        return 2;
    }
}
