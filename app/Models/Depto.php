<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depto extends Model
{
    //Relaccion uno a muchos
    public function plantillas()
    {
        return $this->hasMany(Plantilla::class);
    }
}
