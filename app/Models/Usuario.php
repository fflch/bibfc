<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\Schema;
use App\Models\Unidade;

class Usuario extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;
    protected $guarded = ['id'];

    public function tem_foto(){
        return Storage::exists($this->matricula . '.jpg');
    }

    public static function camposTabela(){
        return array_slice(Schema::getColumnListing('usuarios'), 3);
    }

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }
    
    public function unidade(){
        return $this->belongsTo(Unidade::class);
    }

}
