<x-admin-layout title="Funcionarios | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Funcionarios',
        'href' => route('admin.funcionarios.index'),
    ],
    [
        'name' => 'Editar Funcionario',
    ],
]">

    <form action="{{ route('admin.funcionarios.update', $funcionario) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-wire-card class="mb-1">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex items-center space-x-5">
                    <img src="{{ $funcionario->user->profile_photo_url }}"
                        class="h-20 w-20 rounded-full object-cover object-center" alt="{{ $funcionario->user->name }}">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $funcionario->user->name }}
                        </p>
                    </div>
                </div>


                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline gray href="{{ route('admin.funcionarios.schedules', $funcionario) }}">
                        <i class="fa-solid fa-clock"></i>
                        Horarios
                    </x-wire-button>

                    <x-wire-button type="submit">
                        <i class="fa-solid fa-check"></i>
                        Guardar Cambios
                    </x-wire-button>
                </div>
            </div>
        </x-wire-card>

        <x-wire-card>
            <div class="space-y-4">
                <x-wire-native-select label="Puestos" name="puesto_id">
                    <option value="">
                        Seleccione un comision
                    </option>

                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id }}" @selected($puesto->id == old('puesto_id', $funcionario->puesto_id))>
                            {{ $puesto->name }}
                        </option>
                    @endforeach

                </x-wire-native-select>

                <x-wire-textarea label="Observaciones" name="biography" rows="3"
                    placeholder="Descripcion del Funcionario">{{ old('biography', $funcionario->biography) }}
                </x-wire-textarea>

                <x-wire-native-select
                    label="Estado"
                    name="active"
                    >
                    <option value="1" @selected(old('status', $funcionario->active) == 1)>
                        Activo
                    </option>
                    <option value="0" @selected(old('status', $funcionario->active) == 0)>
                        Inactivo
                    </option>

                </x-wire-native-select>
            </div>
        </x-wire-card>


    </form>


</x-admin-layout>
