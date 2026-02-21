<x-admin-layout
title="Citas | Citas"
    :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Citas',
        'href' => route('admin.appointments.index')
    ],
    [
        'name' => 'Nuevo'
    ]
]">

@livewire('admin.appointment-manager')

</x-admin-layout>
