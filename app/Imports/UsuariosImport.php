<?php

namespace App\Imports;

use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Schema;

class UsuariosImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    //pula o número de linhas desejadas (ajuda caso tenha cabeçalho, por ex.)
    public function startRow(): int 
    {
        if(request()->checkbox){
            return 2; //pula a primeira linha (cabeçalho)
        }else{
            return 1;
        }
    }

    public function model(array $row)
    {
        $campos = array_slice(Schema::getColumnListing('usuarios'), 3);

        $atributos = [];
        foreach($campos as $key => $campo){
            $atributos[$campo] = $row[$key] ?? Auth::user()->unidade_id; //caso não haja ID da unidade no excel será setado automaticamente
        }
        //matricula precisa ser integer
        if(!is_numeric($row[1])){
            throw new \App\Exceptions\CabecalhoInvalidoException('Cabeçalho não removido. Verifique o arquivo');
        }
        return new Usuario($atributos);
    }
}