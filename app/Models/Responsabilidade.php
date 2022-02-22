<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LivroResponsabilidade;
use App\Models\Livro;
use OwenIt\Auditing\Contracts\Auditable;

class Responsabilidade extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $guarded = ['id'];

    public function livros()
    {
        return $this->belongsToMany(Livro::class)
                    ->withPivot('tipo','id')
                    ->withTimestamps()
                    ->using(LivroResponsabilidade::class);
    }
}
