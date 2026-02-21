<?php

namespace App\Livewire\Admin;

use App\Enums\AppointmentEnum;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\ConsultationImagen;
use App\Models\Plantilla;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Facades\File;

class ConsultationManager extends Component
{
    use WithFileUploads;

    public Appointment $appointment;
    public Consultation $consultation;

    public Plantilla $plantilla;
    public $previousConsultations;




    public  $images = [];

      public $form = [
        'diagnosis' => '',
        'treatment' => '',
        'notes' => '',
        'prescriptions' => [],
    ];

     public function mount(Appointment $appointment)
    {
        $this->consultation =$appointment->consultation;

        /* dd($this->consultation); */
        $this->plantilla =$appointment->plantilla;

        $this->previousConsultations =Consultation::whereHas('appointment', function($query){
            $query->where('plantilla_id', $this->plantilla->id);
        })->where('id', '!=', $this->consultation->id)
        ->where('created_at', '<', $this->consultation->created_at)
        ->latest()
        ->take(5)
        ->get();

         $this->form = [
            'diagnosis' => $this->consultation->diagnosis,
            'treatment' => $this->consultation->treatment,
            'notes' => $this->consultation->notes,
            'prescriptions' => $this->consultation->prescriptions ?? [
                [
                    'medicine' => '',
                    'dosage' => '',
                    'frequency' => '',
                ]
            ],
        ];
    }

    public function addPrescription()
    {
        $this->form['prescriptions'][] = [
            'medicine' => '',
            'dosage' => '',
            'frequency' => '',
        ];
    }


    public function removePrescription($index)
    {
        unset($this->form['prescriptions'][$index]);
        $this->form['prescriptions'] =array_values($this->form['prescriptions']);
    }


    public function save()
    {
         /* dd($this->form); */
          /* dd($this->images); */

        $this->validate([
            'form.diagnosis' =>'required|string|max:255',
            'form.treatment' => 'required|string|max:255',
            'form.notes' => 'nullable|string|max:1000',
            'images' => 'nullable|array',
            /* 'form.prescriptions' =>'required|array|min:1',
            'form.prescriptions.*.medicine' => 'required|string|max:255',
            'form.prescriptions.*.dosage' => 'required|string|max:255',
            'form.prescriptions.*.frequency' => 'required|string|max:255', */
        ]);


        /* $this->consultation->update([
            'diagnosis' => $this->form['diagnosis'],
            'treatment' => $this->form['treatment'],
            'notes' => $this->form['notes'],
            'prescriptions' => $this->form['prescriptions'],
        ]); */
        $this->consultation->update($this->form);

        $this->appointment->status = AppointmentEnum::COMPLETED;
        $this->appointment->save();


        foreach ($this->images as $key => $image) {
            $cimage = new ConsultationImagen();
            $cimage->consultation_id = $this->consultation->id;
            $destination = storage_path('app/public/') . $cimage->image_path;

             if (File::exists($destination)) {
                File::delete($destination);
            }

            $imageName = Carbon::now()->timestamp . $key . '.' . $this->images[$key]->extension();

             $this->images[$key]->storeAs('consultas', $imageName);
           /*  copy($this->images[$key]->getRealPath(), storage_path('app/public/consultas/' . $imageName)); */
            /* copy($this->appointment['image']->getRealPath(), storage_path('app/public/appointmentFoto/' . $imageName)); */


            $cimage->image_path = 'consultas/' . $imageName;

            ConsultationImagen::create([
                'consultation_id' => $this->consultation->id,
                'image_path' => $cimage->image_path,
            ]);
        }

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'consulta guardada correctamente',
            'text' => 'Los detalles de la consulta han sido actualizados',
        ]);


    }
    public function render()
    {
        return view('livewire.admin.consultation-manager');
    }
}
