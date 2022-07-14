<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use OwenIt\Auditing\Contracts\Auditable;

class LivroAssunto extends Pivot implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $incrementing = true;
    protected $table = "livro_assuntos";
}
