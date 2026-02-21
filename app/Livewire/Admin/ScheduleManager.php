<?php

namespace App\Livewire\Admin;

use App\Models\Funcionario;
use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ScheduleManager extends Component
{

    public Funcionario $funcionario;
    public $schedule = [];
    public $days = [];

    public $apointment_duration;
    public $start_time;
    public $end_time;
    public $intervals;


    #[Computed()]
    public function hourBlocks()
    {
        return CarbonPeriod::create(
            Carbon::createFromTimeString($this->start_time),
            '1 hour',
            Carbon::createFromTimeString($this->end_time)
        )->excludeEndDate();
    }

    public function mount()
    {
        $this->days = config('schedule.days');
        $this->apointment_duration =config('schedule.apointment_duration');
        $this->start_time = config('schedule.start_time');
        $this->end_time = config('schedule.end_time');

        $this->intervals = 60 / $this->apointment_duration;
        $this->inicializeSchedule();
    }

    public function inicializeSchedule()
    {
        $schedule = $this->funcionario->schedules;


        foreach ($this->hourBlocks as $hourBlock) {
            $period = CarbonPeriod::create(
                $hourBlock->copy(),
                $this->apointment_duration . 'minutes',
                $hourBlock->copy()->addHour()
            );


            foreach ($period as $time) {


                foreach ($this->days as $index => $day) {

                    $this->schedule[$index][$time->format('H:i:s')] = $schedule->contains(function ($schedule) use ($index, $time) {
                        return $schedule->day_of_week == $index && $schedule->start_time->format('H:i:s') == $time->format('H:i:s');
                    });
                }
            }
        }

        /* dd($this->schedule); */
    }


    public function save()
    {
        /* dd($this->schedule); */

        $this->funcionario->schedules()->delete();

        foreach ($this->schedule as $day_of_week => $intervals) {
            foreach ($intervals as $start_time => $isChecked) {
                if ($isChecked) {
                    Schedule::create([
                        'funcionario_id' => $this->funcionario->id,
                        'day_of_week' => $day_of_week,
                        'start_time' => $start_time,
                        'end_time' => Carbon::createFromTimeString($start_time)
                            ->addMinute($this->apointment_duration)
                            ->format('H:i:s'),
                    ]);
                }
            }
        }

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Horario actualizado',
            'text' => 'El horarrio del doctor ha sido actualizado',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.schedule-manager');
    }
}
