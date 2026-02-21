<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'user_id',
        'puesto_id',
        'biography',
        'active'
    ];

    //Relaciones inversas

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function puesto()
    {
        return $this->belongsTo(Puesto::class);
    }

    //relacion uno a muchos
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
