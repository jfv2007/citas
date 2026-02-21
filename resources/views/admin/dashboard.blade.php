<x-admin-layout>
    @role(['Admin','Recepcionista'])
        @include('admin.dashboard.admin')
    @endrole

     @role('Funcionario')
        @include('admin.dashboard.funcionario')
    @endrole

     @role('Trabajador')
        @include('admin.dashboard.trabajador')
    @endrole

</x-admin-layout>
