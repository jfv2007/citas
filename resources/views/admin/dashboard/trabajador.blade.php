<div>
    <x-wire-card>
        <div class="text-center">

            <p class="text-2xl font-semibold text-slate-800">
                Bienvenido a tu panel de control, {{ auth()->user()->name }}.
            </p>
            <p class="mt-2 text-slate-600">
                Aqui tienes un resumen de tu panel de control.
            </p>
            <div class="mt-4 flex items-center justify-center gap-4">
                <x-wire-button href="{{ route('admin.appointments.create') }}" indigo>
                    Reservar nueva cita
                </x-wire-button>
            </div>
        </div>
    </x-wire-card>
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
                       Citas Pasadas
                   </p>
                   <ul class="mt-4 divide-y divide-gray-200">
                       @forelse($data['past_appointments'] as $appointment)
                           <li class="py-2 flex items-center justify-between">
                               <div>
                                   <p class="font-medium text-gray-800">
                                       {{ $appointment->funcionario->user->name }}
                                   </p>
                                   <p class="text-sm text-gray-500">
                                       {{ $appointment->date->format('d/m/Y') }} a las
                                       {{ $appointment->start_time->format('H:i A') }}
                                   </p>
                               </div>
                               <a href="{{ route('admin.appointments.show', $appointment) }}"
                                   class="text-sm text-blue-600 hover:text-blue-800">
                                   Ver Consulta
                               </a>
                           </li>
                       @empty
                           <p class="text-gray-500 ">
                               No hay citas pasadas registradas
                           </p>
                       @endforelse

                   </ul>
               </x-wire-card>
       </div>
    </div>








</div>
