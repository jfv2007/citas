<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Centro extends Model
{
    protected $fillable = [
        'centro_id',
        'centro_des',

    ];
    //Relaccion uno a muchos
    public function plantilla()
    {
        return $this->hasMany(Plantilla::class);
    }

    //Relaccion uno a muchos
   /*  public function plantillas()
    {
        return $this->hasMany(Plantilla::class);
    } */
}
