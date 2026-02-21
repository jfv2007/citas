<?php

namespace App\Models;

use App\Enums\AppointmentEnum;
use App\Models\Scopes\VerifyRole;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/*  #[ScopedBy([VerifyRole::class])]  */

class Appointment extends Model
{
    protected $fillable = [
        'funcionario_id',
        'plantilla_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'asunto',
        'status',
        'image_path'
    ];

    protected $casts = [
        'date' =>'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => AppointmentEnum::class,
    ];


    //Scopes
   /*  public function scopeIsFuncionario($query)
    {
        if(auth()->user()->hasRole('Funcionario')) {
            $query->whereHas('funcionario', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }
    } */

    //Accesores
    public function start(): Attribute
    {
        return Attribute::make(
            get: function(){
                $date =$this->date->format('Y-m-d');
                $time =$this->start_time->format('H:i:s');

                //Retorna
                return Carbon::parse("{$date} {$time}");
            }
        );
    }

    public function end(): Attribute
    {
        return Attribute::make(
            get: function () {
                $date = $this->date->format('Y-m-d');
                $time = $this->end_time->format('H:i:s');

                //Retorna
                return Carbon::parse("{$date} {$time}");
            }
        );
    }
    //relacion uno a uno
    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }

    //relacion inversas
    public function plantilla()
    {
        return $this->belongsTo(Plantilla::class);

    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_path),
        );
    }

}
