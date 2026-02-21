<x-admin-layout title="Citas | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Citas',
        'href' => route('admin.appointments.index'),
    ],
    [
        'name' => 'Detalles',
    ],
]">

    <x-wire-card>

        <x-slot name="title">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Detalles de la Reunion
                </h1>

                <p class="text-sm text-gray-600">
                    Fecha: {{ $appointment->date->format('d-m-Y') }} <br>
                </p>
            </div>


        </x-slot>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h2 class="font-semibold text-gray-500 uppercase text-xs mb-2">
                    Trabajador
                </h2>
                <p class="text-lg font-semibold text-gray-600">
                   Nombre: {{ $appointment->plantilla->user->name }}
                </p>
                <p class="text-lg font-semibold text-gray-600">
                    Centro de Trabajo: {{ $appointment->plantilla->centro->centro_des ?? 'No registrado' }}
                </p>
                <p class="text-lg font-semibold text-gray-600">
                    Situacion Contraltual: {{ $appointment->plantilla->situacionc ?? 'No registrado' }}
                </p>
                <p class="text-lg font-semibold text-gray-600">
                    Ficha: {{ $appointment->plantilla->user->ficha }}
                </p>
                <p class="text-lg font-semibold text-gray-600">
                    Email: {{ $appointment->plantilla->user->email }}
                </p>

            </div>
            <div>
                <h2 class="font-semibold text-gray-500 uppercase text-xs mb-2">
                    Funcionario
                </h2>
                <p class="text-lg font-semibold text-gray-600">
                    Nombre: {{ $appointment->funcionario->user->name }}
                </p>

                </p>
                <p class="text-lg font-semibold text-gray-600">
                   Puesto: {{ $appointment->funcionario->puesto->name }}
                </p>
            </div>
        </div>
        <hr class="my-6">
        <div>
            <h2 class="font-semibold text-gray-800 uppercase  mb-2">
                Imagen de oficio
            </h2>

            <div class="image-wrapper">
                @isset($appointment->image)
                    <img id="picture" src="{{ Storage::url($appointment->image_path) }}" alt="">
                @else
                    <img id="picture" src="https://cdn.pixabay.com/photo/2016/10/11/21/43/geometric-1732847_960_720.jpg"
                        alt="">
                    @endif
                </div>
                <div>


                    <h2 class="font-semibold text-gray-800 uppercase  mb-2">
                        Informe del Asunto del Trabajador
                    </h2>
                    <p class="text-lg font-semibold text-gray-600">
                        {{ $appointment->consultation->diagnosis ?? 'Sin observaciones' }}
                    </p>



                </div>
                <hr class="my-6">
                <div>
                    <h2 class="font-semibold text-gray-800 uppercase  mb-2">
                        Exposicion del Asunto por el Funcionario
                    </h2>
                    <p class="text-lg font-semibold text-gray-600">
                        {{ $appointment->consultation->treatment ?? 'Sin observaciones' }}
                    </p>
                </div>

                <hr class="my-6">
                <div>
                    <h2 class="font-semibold text-gray-800 uppercase  mb-2">
                        Notas de la reunion
                    </h2>
                    <p class="text-lg font-semibold text-gray-600">
                        {{ $appointment->consultation->notes ?? 'Sin observaciones' }}
                    </p>
                </div>
                <hr class="my-6">
                <div>
                    <h2 class="font-semibold text-gray-800 uppercase  mb-2">
                        Imagenes Anexadas al Asunto
                    </h2>
                    @php
                        $images = App\Models\ConsultationImagen::where(
                            'consultation_id',
                            $appointment->consultation->id,
                        )->get();
                    @endphp

                    @foreach ($images as $item)
                        <img src="{{ Storage::url($item->image_path) }}" style="height: 1500px; width: 1000px;" alt="">
                        <hr class="my-6">
                    @endforeach
                </div>


                @role('admin')
                    <hr class="my-6">
                    <div>
                        <h2 class="font-semibold text-gray-800 uppercase  mb-2">
                            Notas del funcionario
                        </h2>

                        <p class="text-lg font-semibold text-gray-600">
                            {{ $appointment->consultation->notes ?? 'Sin observaciones' }}
                        </p>
                    </div>
                @endrole

        </x-wire-card>

    </x-admin-layout>
