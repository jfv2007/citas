<x-admin-layout
title="Funcionarios | Citas"
    :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Funcionarios',
    ]
]">

    @livewire('admin.datatables.funcionario-table')

</x-admin-layout>
