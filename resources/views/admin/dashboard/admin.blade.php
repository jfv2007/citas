  <div class="grid lg:grid-cols-3 gap-3 mb-8">
        <x-wire-card>
            <p class="text-sm font-semibold text-slate-500">
                Total de Trabjadores
            </p>
            <p class=" mt-2  text-4xl font-bold text-indigo-700">
                {{ $data['total_plantillas'] }}
            </p>
        </x-wire-card>

        <x-wire-card>
            <p class="text-sm font-semibold text-slate-500">
                Total de Funcionarios
            </p>
            <p class=" mt-2  text-4xl font-bold text-indigo-700">
                {{ $data['total_funcionarios'] }}
            </p>
        </x-wire-card>

        <x-wire-card>
            <p class="text-sm font-semibold text-slate-500">
                Citas para hoy
            </p>
            <p class=" mt-2  text-4xl font-bold text-indigo-700">
                {{ $data['appointments_today'] }}
            </p>
        </x-wire-card>

    </div>

    <div class="grid lg:grid-cols-3 gap-3">
        <div class="lg:col-span-2">

            <x-wire-card>
                <p class="text-lg font-semibold text-slate-500">
                    Usurios registrados recientemente
                </p>
                <ul class="divide-y divide-gray-200">
                    @foreach ($data['recent_users'] as $user)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $user->name }}
                                </p>
                                <p class="text-sm text-gray-500">
                                    {{ $user->email }}
                                </p>
                            </div>
                            <span class="text-xs text-gray-500">
                                {{ $user->created_at->diffForHumans() }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </x-wire-card>
        </div>


        <x-wire-card>
            <p class="text-lg font-semibold text-slate-900">
                Acciones Rápidas
            </p>
            <div class="mt-4 space-y-2">
                <x-wire-button class="w-full" href="{{ route('admin.plantillas.index') }}" indigo>
                    Gestinar Trabajadores
                </x-wire-button>
                <x-wire-button class="w-full" href="{{ route('admin.funcionarios.index') }}" blue>
                    Gestionar Funcionarios
                </x-wire-button>
                <x-wire-button class="w-full" href="{{ route('admin.appointments.index') }}" gray>
                    Gestionar Citas
                </x-wire-button>

            </div>
        </x-wire-card>
    </div>
