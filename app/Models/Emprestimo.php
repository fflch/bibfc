<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;
use App\Models\Usuario;
use Carbon\Carbon;

class Emprestimo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function getDataEmprestimoAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function getDataDevolucaoAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getPrazoAttribute() {
        if($this->data_emprestimo)
            return Carbon::CreateFromFormat('d/m/Y',$this->data_emprestimo)->addDays(7)->format('d/m/Y');
    }

    public function getAtrasadoAttribute() {
        if(Carbon::now()->gte(Carbon::CreateFromFormat('d/m/Y',$this->data_emprestimo)->addDays(8)))
            return true;
        return false;
    }
}
