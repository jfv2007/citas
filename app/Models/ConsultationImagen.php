<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class ConsultationImagen extends Model
{
    protected $table = 'consultation_images';

    protected $fillable = [
        'consultation_id',
        'image_path',
    ];


    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path),
        );
    }
}
