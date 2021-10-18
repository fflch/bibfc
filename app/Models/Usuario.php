<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Usuario extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tem_foto(){
        return Storage::exists($this->matricula . '.jpg');
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
    
}
