<div class="flex items-center space-x-2">

    @can('update_funcionario')
        <x-wire-button href="{{ route('admin.funcionarios.edit', $funcionario) }}" blue xs>
            <i class="fa-solid fa-pen-to-square"></i>
        </x-wire-button>

        <x-wire-button href="{{ route('admin.funcionarios.schedules', $funcionario) }}" green xs>
            <i class="fa-solid fa-clock"></i>
        </x-wire-button>
    @endcan

</div>
