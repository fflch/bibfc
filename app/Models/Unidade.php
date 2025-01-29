<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\User;
use App\Models\Instance;

class Unidade extends Model
{
    use HasFactory;

    public function usuarios(){
        $this->hasMany(Usuario::class, 'unidade_id');
    }

    public function users(){
        $this->hasMany(User::class, 'unidade_id');
    }

    public function instances(){
        $this->hasMany(Instance::class, 'unidade_id');
    }

}
