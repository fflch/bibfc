<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Responsabilidade;
use App\Models\LivroResponsabilidade;

class Livro extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getLocalizacaoFormatadaAttribute(){
        if(!empty($this->localizacao)){

            $retorno = $this->localizacao;

            if(!empty($this->edicao) && (int) $this->edicao != 1) {
                $retorno .= ' ' . (int) $this->edicao . '.ed.';
            }
                
            if(!empty($this->volume)) {
                $retorno .= ' v.' . $this->volume;
            }

            if(!empty($this->exemplar) && (int) $this->exemplar != 1) {
                $retorno .= ' e.' . (int) $this->exemplar;
            }
            
            if(!empty($this->complemento_localizacao)) {
                $retorno .= ' ' . $this->complemento_localizacao;
            }

            return $retorno;
        }
    }

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }

    public function responsabilidades()
    {
        return $this->belongsToMany(Responsabilidade::class)
                    ->withPivot('tipo','id')
                    ->withTimestamps()
                    ->using(LivroResponsabilidade::class);
    }
}
