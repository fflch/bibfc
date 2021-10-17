<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function getTomboTiposAttribute(){
        $tombo_tipos = env('TOMBO_TIPOS','Padrão');
        return array_map('trim', explode(',', $tombo_tipos));
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

}
