<x-admin-layout title="Usuarios | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Roles',
    ],
]">

    @can('create_user')
        <x-slot name="action">
            <x-wire-button href="{{ route('admin.users.create') }}" blue>
                <i class="fa-solid fa-plus"></i>
                Nuevo
            </x-wire-button>
        </x-slot>
    @endcan

    @livewire('admin.datatables.user-table')


</x-admin-layout>
