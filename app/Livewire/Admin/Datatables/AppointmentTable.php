<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;

class AppointmentTable extends DataTableComponent
{
    public function builder(): \Illuminate\Database\Eloquent\Builder
    {
        $query = Appointment::query()
            ->with('plantilla.user', 'funcionario.user');

         if(auth()->user()->hasRole('Funcionario')) {
            $query->whereHas('funcionario', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }

        if(auth()->user()->hasRole('Trabajador')) {
            $query->whereHas('plantilla', function ($query) {
                $query->where('user_id', auth()->id());
            });
        }


        return $query;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Funcionario Nombre", "funcionario.user.name")
                ->sortable(),
            Column::make("Trabajador Nombre", "plantilla.user.name")
                ->sortable(),
            Column::make("Fecha", "date")
                ->format(function ($value){
                    return $value->format('d/m/y');
                })
                ->sortable(),
            Column::make("Hora", "start_time")
                ->format(function ($value) {
                    return $value->format('H:i');
                })
                ->sortable(),
            Column::make("Hora fin", "end_time")
                ->format(function ($value) {
                    return $value->format('H:i');
                })
                ->sortable(),
            Column::make("Estado", "status")
                ->format(function ($value) {
                    return $value->label();
                })
                ->sortable(),

            Column::make("Acciones")
            ->label(function($row){
                return view('admin.appointments.actions',[
                    'appointment' =>$row
                    ]);
            })

        ];
    }
}
