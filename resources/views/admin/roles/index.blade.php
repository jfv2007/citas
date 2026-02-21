<x-admin-layout title="Roles | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
    ],
]">
    @can('create_role')
        <x-slot name="action">
            <x-wire-button href="{{ route('admin.roles.create') }}" blue>
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </x-wire-button>
        </x-slot>
    @endcan

    @livewire('admin.datatables.role-table')

</x-admin-layout>
