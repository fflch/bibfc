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

    public function getTomboTiposAttribute(){
        $tombo_tipos = env('TOMBO_TIPOS','Padrão');
        return array_map('trim', explode(',', $tombo_tipos));
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function instances()
    {
        return $this->hasMany(Instance::class);
    }

    public function responsabilidades()
    {
        return $this->belongsToMany(Responsabilidade::class)
                    ->withPivot('tipo')
                    ->withTimestamps()
                    ->using(LivroResponsabilidade::class);
    }
}
