<?php

namespace App\Services;

use App\Models\Funcionario;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppointmentService
{
    public function searchAvailability($date ,$hour, $puesto_id)
    {
      /*   dd([
            'date' =>$date,
            'hour' =>$hour,
            'puesto_id' =>$puesto_id,
        ]); */

        $date =Carbon::parse($date);
        $hourStart =Carbon::parse($hour)->format('H:i:s');
        $hourEnd = Carbon::parse($hour)->addHour()->format('H:i:s');


        $funcionarios=Funcionario::whereHas('schedules', function($q) use ($date, $hourStart, $hourEnd){
                $q->where('day_of_week', $date->dayOfWeek)
                    ->where('start_time', '>=' , $hourStart)
                    ->where('start_time', '<', $hourEnd);
        })
            ->whereHas('user', function ($query) {
                $query->role('funcionario');
            })
          ->when($puesto_id , function($q, $puesto_id){
            return $q->where('puesto_id', $puesto_id);
        })
        ->with([
            'user',
            'puesto',
            'schedules' => function($q) use ($date, $hourStart, $hourEnd){
                $q->where('day_of_week', $date->dayOfWeek)
                    ->where('start_time', '>=', $hourStart)
                    ->where('start_time', '<', $hourEnd);
            },
            'appointments' => function($q) use ($date, $hourStart, $hourEnd) {
                    $q->whereDate('date', $date)
                    ->where('start_time', '>=', $hourStart)
                    ->where('start_time', '<', $hourEnd);
            }
        ])
        ->get();

         return $this->processResults($funcionarios);
       /*   $result= $this->processResults($funcionarios); */


        /*  return $result; */
          /* dd($result); */


        /* return $funcionarios; */
       /*  dd($funcionarios->toArray()); */

    }

    public function processResults($funcionarios)
    {
        return $funcionarios->mapWithKeys(function($funcionario){
                $schedules =$this->getAvailableSchedules($funcionario->schedules, $funcionario->appointments);

            /*  return [
                $funcionario->id => [
                    'funcionario' => $funcionario,
                    'schedules' => $schedules,
                ]
            ]; */

            return $schedules->contains('disabled',false)
            ?
            [
                $funcionario->id => [
                    'funcionario' => $funcionario,
                    'schedules' => $schedules,
                ]
            ] : [];
        });
    }

    public function getAvailableSchedules($schedules, $appointments)
    {
           return $schedules->map(function ($schedule) use ($appointments) {

            /* dd($schedule->start_time); */
            /* $isBooked */

            $isBooked = $appointments->some(function($appointment) use ($schedule) {
                    $appointmentPeriod = CarbonPeriod::create(
                        $appointment->start_time,
                        config('schedule.apointment_duration'),
                        $appointment->end_time
                    )->excludeEndDate();

                 /* dd($appointmentPeriod->toArray()); */

                return $appointmentPeriod->contains($schedule->start_time);
                });

                        return [
                            'start_time' => $schedule->start_time->format('H:i:s'),
                            'disabled' => $isBooked,
                        ];
                    });
    }

}
