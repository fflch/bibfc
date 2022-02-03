<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LivroResponsabilidade extends Pivot
{
    public $incrementing = true;

    const tipos = ['Autor', 'Ilustrador', 'Adaptador', 'Organizador'];

    public function getTiposAttribute(){
        return self::tipos;
    }
    
}