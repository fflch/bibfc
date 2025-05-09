<?php

namespace App\Exports;

use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsuariosExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $headings = Usuario::camposTabela();
        return Usuario::select($headings)->where('unidade_id', Auth::user()->unidade_id)->get();
    }

    public function headings(): array
    {
        return[
            'nome',
            'matrícula',
            'observação',
            'prontuário',
            'sala de aula',
            'quarto',
        ];
    }
}
