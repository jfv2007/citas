<x-admin-layout title="Plantilla | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Plantilla',
        'href' => route('admin.plantillas.index'),
    ],
    [
        'name' => 'Editar Trabajador',
    ],
]">

    <form action="{{ route('admin.plantillas.update', $plantilla) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <x-wire-card class="mb-1">
            <div class="lg:flex lg:justify-between lg:items-center">

                <div class="flex items-center space-x-5">
                    <img src="{{ $plantilla->user->profile_photo_url }}"
                        class="h-20 w-20 rounded-full object-cover object-center" alt="{{ $plantilla->user->name }}">
                    <div>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $plantilla->user->name }}
                        </p>
                    </div>
                </div>


                <div class="flex space-x-3 mt-6 lg:mt-0">
                    <x-wire-button outline gray href="{{ route('admin.plantillas.index') }}">
                        Volver
                    </x-wire-button>

                    <x-wire-button type="submit">
                        <i class="fa-solid fa-check"></i>
                        Guardar Cambios
                    </x-wire-button>
                </div>

            </div>
        </x-wire-card>


        <x-wire-card>
            {{-- Tabs --}}
            <x-tabs active="datos-personales">
                <x-slot name="header">
                    <x-tab-link tab="datos-personales">
                        <i class=" fa-solid fa-user me-2"></i>
                        Datos Personales
                    </x-tab-link>

                    <x-tab-link tab="datos-centro">
                        <i class="fa-solid fa-file-lines me-2"></i>
                        Datos Centro del trabajo
                    </x-tab-link>

                    <x-tab-link tab="contacto">
                        <i class="fa-solid fa-heart me-2"></i>
                        Contacto de Emergencia
                    </x-tab-link>
                </x-slot>


                    {{-- Datos personales --}}
                    <x-tab-contect tab="datos-personales">
                        <x-wire-alert info title="Edicion de usuario" class="mb-4">
                            <x-slot name="title" class="italic !font-bold">
                                <div>
                                    para editar esta informacion, dirigete al
                                    <a href="{{ route('admin.users.edit', $plantilla->user) }}"
                                        class="text-blue-600 hover:underline" target="_blank">
                                        perfil de usuario
                                    </a>
                                    asociado al trabajador
                                </div>
                                <div>

                                </div>
                            </x-slot>
                        </x-wire-alert>

                        <div class="grid lg:grid-cols-2 gap-4">
                            <div>
                                <span class="text-blue-500 font-semibold text-sm">
                                    Ficha:
                                </span>
                                <span class="text-blue-900 text-sm ml-1">
                                    {{ $plantilla->user->ficha }}
                                </span>
                            </div>
                            <div>
                                <span class="text-blue-500 font-semibold text-sm">
                                    Telefono:
                                </span>
                                <span class="text-blue-900 text-sm ml-1">
                                    {{ $plantilla->user->phone }}
                                </span>
                            </div>
                            <div>
                                <span class="text-blue-500 font-semibold text-sm">
                                    Email:
                                </span>
                                <span class="text-blue-900 text-sm ml-1">
                                    {{ $plantilla->user->email }}
                                </span>
                            </div>
                            <div>
                                <span class="text-blue-500 font-semibold text-sm">
                                    Direccion:
                                </span>
                                <span class="text-blue-900 text-sm ml-1">
                                    {{ $plantilla->user->address }}
                                </span>
                            </div>
                            <div>
                                <x-wire-native-select label="Estado" class="mb-4" name="estado_id">
                                    <option value="">
                                        Seleccione un Estado
                                    </option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado->id }}" @selected($estado->id === $plantilla->estado_id)>
                                            {{ $estado->nombre }}
                                        </option>
                                    @endforeach
                                </x-wire-native-select>
                            </div>
                            <div>
                                <x-wire-native-select label="Cuidad o Municipio" class="mb-4" name="ciudad_id">
                                    <option value="">
                                        Seleccione una Ciudad o Municipio
                                    </option>
                                    @foreach ($ciudads as $ciudad)
                                        <option value="{{ $ciudad->id }}" @selected($ciudad->id === $plantilla->ciudad_id)>
                                            {{ $ciudad->nombre }}
                                        </option>
                                    @endforeach


                                    {{-- Ciudad --}}
                                 {{--    <div class=" col-md-6 p2">
                                         <div wire:ingone>
                                            @if ($selectedEstado != 0 && !is_null($selectedEstado))
                                                <label for="selectedCiudad" class="text-primary">Cuidades</label>
                                                <select wire:model="selectedCiudad"
                                                    class="form-control @error('selectedCiudad') is-invalid @enderror">
                                                    @foreach ($ciudads as $ciudad)
                                                        <option value="{{ $ciudad->id }}"
                                                            class="p-3 mb-2 bg-danger text-white">
                                                            {{ $ciudad->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('selectedCiudad')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                            @endif
                                         </div>
                                    </div> --}}

                                </x-wire-native-select>
                            </div>
                            <div class="space-y-4">
                                <x-wire-input label="Codigo postal:" type="number" name="cp"
                                    value="{{ old('cp', $plantilla->cp) }}">
                                </x-wire-input>

                            </div>
                            <div>
                                {{-- Imagen --}}

                                <div class="mb-4 relative">
                                    <Label>
                                        Foto de perfil
                                    </Label>
                                    <img id="imgPreview" class="aspect-[16/9]  object-center w-full"
                                        src="{{ $plantilla->image_path ? Storage::url($plantilla->image_path) : asset('img/no dispo.png') }}"
                                        alt="">

                                    <div class="absolute top-8 right-8">
                                        <label
                                            class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                                            <i class="fas fa-camera mr-2"></i>
                                            Actualizar imagen
                                            <input type="file" class="hidden" accept="image/*" name="image"
                                                onchange="preview_image(event,'#imgPreview')">
                                        </label>
                                    </div>

                                </div>


                                {{--  <figure class="relative mb-4">
                                    <x-validation-errors class="mb-4" />
                                    <div class="absolute top-8 right-8">
                                        <label
                                            class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                                            <i class="fas fa-camera mr-2"></i>
                                            Actualizar imagen

                                            <input type="file" class="hidden" accept="image/*" name="image"
                                                onchange="preview_image(event, '#imgPreview')">

                                        </label>
                                    </div>
                                    <img src="{{ $plantilla->image }}" alt=""
                                        class="aspect-[3/1] w-full object-cover object-center" id="imgPreview">
                                </figure> --}}
                            </div>

                        </div>
                    </x-tab-contect>

                    {{-- datos-centro --}}
                    <x-tab-contect tab="datos-centro">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div>
                                <x-wire-native-select label="Centro de Trabajo" class="mb-4" name="centro_id">
                                    <option value="">
                                        Seleccione un Centro de trabajo
                                    </option>
                                    @foreach ($centros as $centro)
                                        <option value="{{ $centro->id }}" @selected($centro->id === $plantilla->id)>
                                            {{ $centro->centro_des }}
                                        </option>
                                    @endforeach

                                </x-wire-native-select>
                            </div>
                            <div>
                                <x-wire-native-select label="Depto de Trabajo" class="mb-4" name="depto_id">
                                    <option value="">
                                        Seleccione un Depto de trabajo
                                    </option>
                                    @foreach ($deptos as $depto)
                                        <option value="{{ $depto->id }}" @selected($depto->id === $plantilla->id)>
                                            {{ $depto->depto_des }}
                                        </option>
                                    @endforeach
                                </x-wire-native-select>
                            </div>
                            <div>
                                <x-wire-native-select label="Situacion Contractual" class="mb-4" name="situacionc">
                                    <option value="">
                                        Seleccione Situacion contractual
                                    </option>

                                    <option value="PLANTA" @selected($plantilla->situacionc)>PLANTA</option>
                                    <option value="TRANSITORIO" @selected($plantilla->situacionc)>TRANSITORIO</option>
                                    <option value="JUBILADO" @selected($plantilla->situacionc)>JUBILADO</option>
                                    <option value="CONFIANZA ACTIVO" @selected($plantilla->situacionc)>CONFIANZA ACTIVO
                                    </option>
                                    <option value="CONFIANZA JUBILADO" @selected($plantilla->situacionc)>CONFIANZA JUBILADO
                                    </option>
                                    <option value="FALLECIDO" @selected($plantilla->situacionc)>FALLECIDO</option>

                                </x-wire-native-select>
                            </div>
                        </div>
                    </x-tab-contect>

                    {{-- informacion-general --}}
                   <x-tab-contect tab="informacion-general">
                        informacion general
                    </x-tab-contect>

                    {{-- contacto --}}
                    <x-tab-contect tab="contacto">
                        <div class="grid lg:grid-cols-2 gap-4">
                            <div class="space-y-4">
                                <x-wire-input label="Contacto de emergencia:" type="text" name="c_emergencia"
                                    value="{{ old('c_emergencia', $plantilla->c_emergencia) }}">
                                </x-wire-input>
                            </div>

                            <div class="space-y-4">
                                <x-wire-input label="Telefono de Emergencia:" type="number" name="t_emergencia"
                                    value="{{ old('t_emergencia', $plantilla->t_emergencia) }}">
                                </x-wire-input>
                            </div>

                            <div>
                                <x-wire-native-select label="Tipo de Sangre" class="mb-4" name="blode_type_id">
                                    <option value="">
                                        Seleccione un Tipo de Sangre
                                    </option>
                                    @foreach ($blodTypes as $blodType)
                                        <option value="{{ $blodType->id }}" @selected($blodType->id === $plantilla->blode_type_id)>
                                            {{ $blodType->name }}
                                        </option>
                                    @endforeach
                                </x-wire-native-select>
                            </div>

                        </div>
                    </x-tab-contect>

            </x-tabs>
        </x-wire-card>
    </form>
</x-admin-layout>
