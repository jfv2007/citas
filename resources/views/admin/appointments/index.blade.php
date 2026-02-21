<x-admin-layout title="Citas | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Citas',
    ],
]">

    @can('create_appointment')
        <x-slot name="action">
            <x-wire-button href="{{ route('admin.appointments.create') }}" blue>
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </x-wire-button>
        </x-slot>
    @endcan


    @livewire('admin.datatables.appointment-table')

</x-admin-layout>
