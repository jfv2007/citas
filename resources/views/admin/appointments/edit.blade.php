<x-admin-layout title="Citas | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Citas',
        'href' => route('admin.appointments.index'),
    ],
    [
        'name' => 'Editar Cita',
    ],
]">

    <x-slot name="action">
        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" >
            @csrf
            @method('DELETE')
            <x-wire-button red type="submit" sm>
                Cancelar Cita
            </x-wire-button>
        </form>
    </x-slot>


    <x-wire-card class="mb-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-g font-medium">
                    Editando la Cita para:
                    <span class="font-bold text-indigo-700">
                        {{ $appointment->plantilla->user->name }}
                    </span>
                </p>
                <p>
                    Fecha de la Cita:
                    <span class="font-semibold text-slate-700">
                        {{ $appointment->date->format('d/m/y') }} a las
                        {{ $appointment->start_time->format('H:i:s') }}
                    </span>
                </p>
            </div>

            <div>
                <x-wire-badge flat :color="$appointment->status->color()" :label="$appointment->status->label()" />

            </div>
        </div>
    </x-wire-card>

    @if ($appointment->status->isEditable())
        @livewire('admin.appointment-manager', [
            'appointmentEdit' => $appointment,
        ])
    @else
        <x-wire-card>
            <p class="text-center text-slate-500">
                Esta cita no se puede editar debido porque ha sido completada o cancelada.
            </p>
        </x-wire-card>
    @endif

</x-admin-layout>
