<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LivroResponsabilidade extends Pivot
{
    public $incrementing = true;

    public function getTiposAttribute(){
        return ['Autor', 'Ilustrador', 'Adaptador', 'Organizador'];
    }
    
}