<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AppointmentEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;

use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read_appointment');

        return view('admin.appointments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create_appointment');

        return view('admin.appointments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create_appointment');



     /*    $data = $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'description' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,completed,canceled',
        ]);

        Appointment::create($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita creada correctamente',
            'text' => 'La cita ha sido creada exitosamente',
        ]);

        return redirect()->route('admin.appointments.index'); */
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        Gate::authorize('read_appointment');

        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($appointmentId)
    {

        $appointment= Appointment::query();
            if(auth()->user()->hasRole('Funcionario')) {
                $appointment->whereHas('funcionario', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            }

              if(auth()->user()->hasRole('Trabajador')) {
                $appointment->whereHas('plantilla', function ($query) {
                    $query->where('user_id', auth()->id());
                });
            } 

        $appointment = Appointment::findOrFail($appointmentId);

        Gate::authorize('update_appointment');

        return view('admin.appointments.edit', compact('appointment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        Gate::authorize('update_appointment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        Gate::authorize('delete_appointment');

        $appointment->status = AppointmentEnum::CANCELLED;
        $appointment->save();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Cita cancelada correctamente',
            'text' => 'La cita ha sido cancelada exitosamente',
        ]);

        return redirect()->route('admin.appointments.edit', $appointment);
    }
    public function consultation(Appointment $appointment)
    {
        Gate::authorize('update_appointment');

        return view('admin.appointments.consultation', compact('appointment'));
    }
}
