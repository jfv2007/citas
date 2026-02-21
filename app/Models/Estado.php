<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = [
        'name',
    ];

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }

}
