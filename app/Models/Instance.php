<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Instance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $guarded = ['id'];

    const status = ['Ativo', 'Perdido', 'Muito Atrasado', 'Danificado','Descartado'];


    public static function tombo_tipos(){
        $tombo_tipos = env('TOMBO_TIPOS','Padrão');
        return array_map('trim', explode(',', $tombo_tipos));
    }

    public function getTomboTiposAttribute(){
        $tombo_tipos = env('TOMBO_TIPOS','Padrão');
        return array_map('trim', explode(',', $tombo_tipos));
    }

    public function getStatusListAttribute(){
        return self::status;
    }

    public function livro(){
        return $this->belongsTo(Livro::class);
    }

    public function emprestimos(){
        return $this->hasMany(Emprestimo::class);
    }
}