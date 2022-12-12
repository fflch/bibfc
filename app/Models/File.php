<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Tcc;

class File extends Model
{
    use HasFactory;

    public function tccs(){
        return $this->belongsTo(Tcc::class);
    }
}
