<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LivroResponsabilidade;
use App\Models\Livro;

class Responsabilidade extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function livros()
    {
        return $this->belongsToMany(Livro::class)
                    ->withPivot('tipo')
                    ->withTimestamps()
                    ->using(LivroResponsabilidade::class);
    }
}
