<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $fillable = [
        'appointment_id',
        'diagnosis',
        'treatment',
        'notes',
        'prescriptions'
    ];

    protected $cats =[
        'prescriptions' =>'json',
    ];

    //relacion inversa con appointment
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    //relacion con consultation_images
    
}
