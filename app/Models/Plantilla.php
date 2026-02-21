<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Plantilla extends Model
{
    protected $fillable = [
        'user_id ',
        'depto_id',
        'centro_id',
        'cp',
        'estado_id',
        'ciudad_id',
        'curp',
        'sexo',
        'blode_type_id',
        'c_emergencia',
        't_emergencia',
        'situacionc',
        'texto',
        'image_path',
        'qrgenerado',
    ];


    //relacion  inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relacion inversa
    public function blodType()
    {
        return $this->belongsTo(BlodeType::class);
    }

    //relacion inversa
    public function centro()
    {
        return $this->belongsTo(Centro::class);
    }

    //relacion inversa
    public function depto()
    {
        return $this->belongsTo(Depto::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path),
        );
    }

}
