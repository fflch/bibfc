<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
}
