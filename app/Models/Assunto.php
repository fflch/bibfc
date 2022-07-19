<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use App\Models\LivroAssunto;
use App\Models\Livro;

class Assunto extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    protected $guarded = ['id'];

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function irmaos()
    {
        if ($this->parent_id != null) {
            return Assunto::where('parent_id', $this->parent_id)->get();
        }

        return;
    }

    public function livros()
    {
        return $this->belongsToMany(Livro::class, 'livro_assuntos')
                    ->withPivot('id')
                    ->withTimestamps()
                    ->using(LivroAssunto::class);
    }
}
