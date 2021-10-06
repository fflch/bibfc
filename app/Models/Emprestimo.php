<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;
use App\Models\Usuario;

class Emprestimo extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function getDataEmprestimoAttribute($value) {
        return implode('/',array_reverse(explode('-',$value)));
    }
    
    public function getDataDevolucaoAttribute($value) {
        return implode('/',array_reverse(explode('-',$value)));
    }
}
