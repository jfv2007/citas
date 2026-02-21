<x-admin-layout
title="Usuarios | Citas"
    :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'), 
    ],
    [
        'name' => 'Usuarios',
        'href' => route('admin.users.index'),
    ],
    [
        'name' => 'Editar Usuario',
    ]
]">

    <x-wire-card>

        <form action="{{ route('admin.users.update', $user ) }}" method="POST" >
            @csrf
            @method('PUT')
            <div class="space-y-4">

                <div class="grid lg:grid-cols-2 gap-4">
                    <x-wire-input label="Nombre" name="name" placeholder="Nombre del usuario" value="{{ old('name',$user->name) }}" />
                    <x-wire-input label="Email" name="email" type="email" placeholder="Email del usuario" value="{{ old('email', $user->email) }}" />
                    <x-wire-input label="Contraseña" name="password" type="password"  placeholder="Contraseña del usuario" />
                    <x-wire-input label="Confirmar Contraseña" name="password_confirmation" type="password"  placeholder="Confirma la contraseña" />
                   {{--  <x-wire-input label="Puesto" name="dni" required placeholder="Puesto del Usuario" value="{{ old('dni', $user->dni ) }}" /> --}}
                    <x-wire-input label="Teléfono" name="phone" :mask="['(###) ###-####', '+# ### ###-####', '+## ## ####-####']" required placeholder="Teléfono del Usuario" value="{{ old('phone', $user->phone ) }}" />
  
                <x-wire-input label="Dirección" name="address" required placeholder="Dirección del Usuario" value="{{ old('address', $user->address) }}" /> 

  

                <x-wire-native-select
                    label="Rol"
                    name="role_id">
                    <option value="">
                        Seleccione un rol
                    </option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"  
                            @selected(old('role_id', $user->roles->first()->id) == $role->id)
                            >
                            {{ $role->name }}
                        </option>
                    @endforeach
                </x-wire-native-select>

                
                
                <div class="flex justify-end">
                    <x-wire-button type="submit" >
                        Actualizar
                    </x-wire-button>
                </div>

            </div>
        </form>

    </x-wire-card>
   



   
</x-admin-layout>