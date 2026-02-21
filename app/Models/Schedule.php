<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'funcionario_id',
        'day_of_week',
        'start_time',
        'end_time',
    ];

    protected $casts =[
        'day_of_week'=> 'integer',
        'start_time' => 'datetime',
        'end_time' => 'datetime',

    ];
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
