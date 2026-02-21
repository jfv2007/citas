<div>
    <div class="grid lg:grid-cols-4 gap-6 mb-8">

        <x-wire-card class="lg:col-span-2">
            <p class="text-2xl font-bold text-gray-500">
                ¡Buen dia Sr(a) {{ auth()->user()->name }}!
            </p>
            <p class="mt-1 text-gray-400">
                Aqui esta el resumen de su jornada
        </x-wire-card>



        <x-wire-card>

            <p class="text-sm font-bold text-gray-500">
                Citas de Hoy
            </p>
            <p class="mt-2 text-3xl semi-bold text-gray-500">
                {{ $data['appointments_today_count'] }}

            </p>
        </x-wire-card>

        <x-wire-card>

            <p class="text-sm font-bold text-gray-500">
                Citas de la Semana
            </p>
            <p class="mt-2 text-3xl semi-bold text-gray-500">
                {{ $data['appointments_week_count'] }}

            </p>
        </x-wire-card>

    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <div>
            <x-wire-card>
                <p class="text-lg font-semibold text-gray-900">
                    Proximas Citas Pendientes
                </p>
                @if ($data['next_appointment'])
                    <p class="mt-4 font-semibold text-sm text-gray-500">
                        {{ $data['next_appointment']->plantilla->user->name }}
                    </p>
                    <p class="text-gray-600 mb-4">
                        {{ $data['next_appointment']->date->format('d/m/Y') }} a las
                        {{ $data['next_appointment']->start_time->format('H:i A') }}
                    </p>
                    <x-wire-button class="mt-4" :href="route('admin.appointments.consultation', $data['next_appointment'])" class="w-full" primary>
                        Ver Detalles
                    </x-wire-button>
                @else
                    <p class="mt-2  text-gray-500">
                        No hay citas programadas para hoy.
                    </p>
                @endif
            </x-wire-card>
        </div>

        <div class="lg:col-span-2">
            <x-wire-card>
                <p class="text-lg font-semibold text-gray-900">
                    Citas Pendientes
                </p>
                <ul class="mt-4 divide-y divide-gray-200">
                    @forelse($data['appointments_today'] as $appointment)
                        <li class="py-2 flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-800">
                                    {{ $appointment->plantilla->user->name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $appointment->date->format('d/m/Y') }} a las
                                    {{ $appointment->start_time->format('H:i A') }}
                                </p>
                            </div>
                            <a href="{{ route('admin.appointments.consultation', $appointment) }}"
                                class="text-sm text-blue-600 hover:text-blue-800">
                                Gestionar
                            </a>
                        </li>
                    @empty
                        <p class="text-gray-500 ">
                            No hay citas pendientes.
                        </p>
                    @endforelse

                </ul>
            </x-wire-card>
        </div>

    </div>
</div>
