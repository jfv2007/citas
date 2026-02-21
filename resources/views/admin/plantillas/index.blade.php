<x-admin-layout
title="Plantilla | Citas"
    :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'), 
    ],
    [
        'name' => 'Plantilla',
    ]
]">

    @livewire('admin.datatables.plantilla-table')
    
</x-admin-layout>