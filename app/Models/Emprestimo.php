<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;
use App\Models\Instance;
use App\Models\Usuario;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;

class Emprestimo extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $guarded = ['id'];

    public function instance()
    {
        return $this->belongsTo(Instance::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function getDataEmprestimoAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function getDataDevolucaoAttribute($value) {
        if($value)
            return Carbon::parse($value)->format('d/m/Y');
    }

    public function getPrazoAttribute() {
        if($this->data_emprestimo){
            $prazo = $this->renew*7 + 7;
            return Carbon::CreateFromFormat('d/m/Y',$this->data_emprestimo)->addDays($prazo)->format('d/m/Y');
        }
            
    }

    public function getAtrasadoAttribute() {
        $prazo = $this->renew*7 + 7 + 1;
        if(Carbon::now()->gte(Carbon::CreateFromFormat('d/m/Y',$this->data_emprestimo)->addDays($prazo)))
            return true;
        return false;
    }

    public function getDiasAttribute() {
        $data_emprestimo = Carbon::CreateFromFormat('d/m/Y',$this->data_emprestimo);
        if($this->data_devolucao == null || empty($this->data_devolucao) || !isset($this->data_devolucao)) {
            return "Não devolvido";
        }
        $data_devolucao = Carbon::CreateFromFormat('d/m/Y',$this->data_devolucao);
        
        return $data_emprestimo->diffInDays($data_devolucao);
    }
}
