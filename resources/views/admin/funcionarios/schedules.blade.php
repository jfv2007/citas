<x-admin-layout
title="Funcionarios | Citas"
    :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Horarios',
    ]
]">

   @livewire('admin.schedule-manager', [
    'funcionario' => $funcionario
   ])

</x-admin-layout>
