<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Puesto;
use App\Services\AppointmentService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Facades\File;

class AppointmentManager extends Component
{ use \Livewire\WithFileUploads;

    public ?Appointment $appointmentEdit = null;

    public $search = [
        'date' => '',
        'hour' => '',
        'puesto_id' => '',
    ];

    public $selectedSchedules = [
        'funcionario_id' => '',
        'schedules' => [],
    ];

    public $puestos = [];
    public $availabilities = [];

    public $appointment = [
        'plantilla_id' =>'',
        'funcionario_id' => '',
        'date'=>'',
        'start_time' => '',
        'end_time' => '',
        'duration' => '',
        'asunto' => '',
        'image' => '',
    ];


    public function mount()
    {
        $this->puestos=Puesto::all();
        $this->search['date'] = now()->hour >= 12
            ? now()->addDay()->format('Y-m-d')
            : now()->format('Y-m-d');

        if ($this->appointmentEdit){

                $this->appointment['plantilla_id'] = $this->appointmentEdit->plantilla_id;
        }

        //Verificar si es paciente
        if(auth()->user()->hasRole('Trabajador')){
            $this->appointment['plantilla_id'] = auth()->user()->plantilla->id;
        }
    }

    public function updated($property, $value)
    {
        if($property === 'selectedSchedules')
        {
            $this->fillAppointment($value);
        }
    }

    public function fillAppointment($selectedSchedules)
    {
        /* dd($value); */
        $schedules = collect($selectedSchedules['schedules'])
        ->sort()
        ->values();

        /* dd($schedules->fisrt()); */
        if($schedules->count()){
            $this->appointment['funcionario_id'] = $selectedSchedules['funcionario_id'] ;
            $this->appointment['start_time'] =$schedules->first();
            $this->appointment['end_time'] = Carbon::parse($schedules->last())->addMinutes(config('schedule.apointment_duration'))->format('H:i:s');
            $this->appointment['duration'] = $schedules->count()* config('schedule.apointment_duration');

            return;
        }

        $this->appointment['funcionario_id'] = "";
        $this->appointment['start_time'] = "";
        $this->appointment['end_time'] = "";
        $this->appointment['duration'] = "";

        /* dd($this->appointment); */
    }

    #[Computed()]
    public function hourBlocks()
    {
        return CarbonPeriod::create(
            Carbon::createFromTimeString( config('schedule.start_time')),
            '1 hour',
            Carbon::createFromTimeString(config('schedule.end_time'))
        )->excludeEndDate();
    }

    #[Computed()]
    public function funcionarioName()
    {
        return $this->appointment['funcionario_id']
            ? $this->availabilities[$this->appointment['funcionario_id']]['funcionario']->user->name
            : 'Por definir';
    }

    public function searchAvailability(AppointmentService $service)
    {
        $this->validate([
            'search.date' =>'required|date|after_or_equal:today',
            'search.hour' =>[
                'required',
                'date_format:H:i:s',
                Rule::when($this->search['date'] === now()->format('Y-m-d'), [
                    'after_or_equal:' . now()->format('H:i:s')
                ])
            ],
        ]);

        $this->appointment['date']= $this->search['date'];



        //buscar disponibilidad
        /* dd(...$this->search); */

        $this->availabilities = $service->searchAvailability(...$this->search);
    }

    public function save()
    {
        $this->validate([
            'appointment.plantilla_id' => 'required|exists:plantillas,id',
            'appointment.funcionario_id' => 'required|exists:funcionarios,id',
            'appointment.date' => 'required|date|after_or_equal:today',
            'appointment.start_time' => 'required|date_format:H:i:s',
            'appointment.end_time' => 'required|date_format:H:i:s|after:appointment.start_time',
            'appointment.asunto' => 'nullable|string|max:255',
            'appointment.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        /*   dd($this->appointment); */

        $activo = new Appointment();

        $activo->plantilla_id = $this->appointment['plantilla_id'];
        $activo->funcionario_id = $this->appointment['funcionario_id'];
        $activo->date = $this->appointment['date'];
        $activo->start_time = $this->appointment['start_time'];
        $activo->end_time = $this->appointment['end_time'];
        $activo->asunto = $this->appointment['asunto'];


        if ($this->appointment['image']) {
            $destination = storage_path('app/public/') . $activo->image_path;
             /* dd($activo->image_path); */
             /* dd($destination); */


             if (File::exists($destination)) {
                File::delete($destination);
            }

            $imageName = Carbon::now()->timestamp . '.' . $this->appointment['image']->extension();
            copy($this->appointment['image']->getRealPath(), storage_path('app/public/appointmentFoto/' . $imageName));
            /* copy(storage_path('app/public/appointmentFoto/' . $imageName), $imageName); */

            $activo->image_path = 'appointmentFoto/' . $imageName;
             $activo->save();
        }

        $consulta = new Consultation();
        $consulta->appointment_id = $activo->id;
        $consulta->save();



        if($this->appointmentEdit)
        {
            $this->appointmentEdit->update($this->appointment);

            $this->dispatch('swal', [
                    'icon' => 'success',
                    'title' => 'Cita actualizada correctamente',
                    'text' => 'La cita ha sido actualizada exitosamente',
                ]);

                $this->searchAvailability(new AppointmentService());
                return;
        }


        /* Appointment::create($this->appointment)
            ->consultation()
            ->create([]); */

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Cita creada correctamente',
            'text' => 'La cita ha sido registrada exitosamente',
        ]);

        return redirect()->route('admin.appointments.index');
    }


    public function render()
    {
        return view('livewire.admin.appointment-manager');
    }
}
