<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Responsabilidade;
use App\Models\LivroResponsabilidade;
use App\Models\Assunto;
use App\Models\LivroAssunto;
use OwenIt\Auditing\Contracts\Auditable;

class Livro extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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

    public static function tipologia(){
        return[
            'Gibi',
            'História em Quadrinhos',
            'Revista',
            'Livro'
        ];
    }

    public static function idiomas(){
        return [
            'PT-BR' => 'Português do Brasil',
            'PT' => 'Português',
            'EN' => 'Inglês',
            'ES' => 'Espanhol',
            'FR' => 'Francês',
            'DE' => 'Alemão',
            'IT' => 'Italiano',
            'RU' => 'Russo',
            'ZH' => 'Chinês',
            'JA' => 'Japonês',
            'AR' => 'Árabe',
            'HI' => 'Hindi',
            'KO' => 'Coreano',
            'TR' => 'Turco',
            'NL' => 'Holandês',
            'SV' => 'Sueco',
            'PL' => 'Polonês',
            'EL' => 'Grego',
            'DA' => 'Dinamarquês',
            'NO' => 'Norueguês',
            'FI' => 'Finlandês',
        ];
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

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assuntos')
                    ->withPivot('id')
                    ->withTimestamps()
                    ->using(LivroAssunto::class);
    }

    public function livro_assuntos(){
        return $this->hasMany(LivroAssunto::class);
    }

    public function livro_responsabilidades(){
        return $this->hasMany(LivroResponsabilidade::class);
    }

}
