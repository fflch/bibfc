<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Livro;

class LivroResponsabilidade extends Pivot implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $incrementing = true;

    const tipos = ['Autor', 'Ilustrador', 'Adaptador', 'Organizador'];

    public function getTiposAttribute(){
        return self::tipos;
    }
    public function livro(){
        return $this->belongsTo(Livro::class);
    }
}