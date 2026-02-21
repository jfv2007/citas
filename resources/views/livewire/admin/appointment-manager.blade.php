<div x-data="data()">
    <x-wire-card>
        <P class="text-xl font-semibold mb-1 text-slate-800">
            Buscar Disponibilidad
        </P>
        <p>
            Encuentra el horario perfecto para tu cita.
        </p>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <x-wire-input label="Fecha" type="date" wire:model="search.date" placeholder="Seleccione una fecha" />


            <x-wire-select label="Hora" wire:model="search.hour" placeholder="Seleccione una hora">

                @foreach ($this->hourBlocks as $hourBlock)
                    <x-wire-select.option :label="$hourBlock->format('H:i:s') . '-' . $hourBlock->copy()->addHour()->format('H:i:s')" :value="$hourBlock->format('H:i:s')" />
                @endforeach

            </x-wire-select>



            <x-wire-select label="Puesto (opcional)" wire:model="search.puesto_id" placeholder="Seleccione un Puesto">

                @foreach ($this->puestos as $puesto)
                    <x-wire-select.option :label="$puesto->name" :value="$puesto->id" />
                @endforeach

            </x-wire-select>

            <div class="lg:pt-6.5">
                <x-wire-button wire:click="searchAvailability" class="w-ful" color="primary" :disabled="$appointmentEdit && !$appointmentEdit->status->isEditable()">
                    Buscar Disponibiliad
                </x-wire-button>
            </div>

        </div>
    </x-wire-card>


    @if ($appointment['date'])
        @if (count($availabilities))
            <div class="grid lg:grid-cols-3 gap-4 lg:gap-8">
                <div class="col-span-1 lg:col-span-2 space-y-6">

                    @foreach ($availabilities as $availability)
                        {{-- @json($availability) --}}
                        <x-wire-card>
                            <div class="flex items-center space-x-4 ">
                                <img class="h-16 w-16 rounded-full object-cover"
                                    src="{{ $availability['funcionario']->user->profile_photo_path }}" alt="">

                                <div>
                                    <p class="text-xl font-bold text-slate-800">
                                        {{ $availability['funcionario']->user->name }}
                                        {{ $availability['funcionario']->id }}
                                        {{-- @json($availability) --}}
                                    </p>
                                    <p class="text-sm text-blue-600 font-medium">
                                        {{ $availability['funcionario']->puesto?->name ?? 'Sin especialidad' }}
                                    </p>

                                </div>
                            </div>

                            <hr class="my-5">

                            <div>
                                <p class="text-sm text-slate-600 mb-2 font-semibold">
                                    Horarios Disponible:
                                </p>

                                <ul class="grid grid-col-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                                    @foreach ($availability['schedules'] as $schedule)
                                        {{-- @json($availability['funcionario']->id)  --}}
                                        <li>
                                            <x-wire-button :disabled="$schedule['disabled']" :color="$schedule['disabled'] ? 'secondary' : 'primary'"
                                                x-on:click="selectSchedule({{ $availability['funcionario']->id }}, '{{ $schedule['start_time'] }}')"
                                                x-bind:class="selectedSchedules.funcionario_id ===
                                                    {{ $availability['funcionario']->id }} && selectedSchedules
                                                    .schedules.includes('{{ $schedule['start_time'] }}') ?
                                                    'opacity-50' : ''"
                                                class="w-full">
                                                {{ $schedule['start_time'] }}
                                            </x-wire-button>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                        </x-wire-card>
                    @endforeach

                </div>

                <div class="col-span-1">
                    {{-- @json($selectedSchedules) --}}

                    <x-wire-card>
                        <p class="text-xl font-semibold mb-4 text-slate-800">
                            Resumen de la Cita
                        </p>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Funcionario:
                                </span>
                                <span class="font-semibold text-slate-700">
                                    {{ $this->funcionarioName }}
                                </span>
                            </div>
                            {{--            @if ($selectedSchedules['funcionario_id'])
                                    @json($availabilities[$selectedSchedules['funcionario_id']]['funcionario']->user->name)

                                @endif --}}

                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Fecha:
                                </span>
                                <span class="font-semibold text-slate-700">
                                    {{ $appointment['date'] }}
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Horario:
                                </span>
                                <span class="font-semibold text-slate-700">
                                    @if ($appointment['duration'])
                                        {{ $appointment['start_time'] }} - {{ $appointment['end_time'] }}
                                    @else
                                        por definir
                                    @endif
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-slate-500">
                                    Duracion:
                                </span>
                                <span class="font-semibold text-slate-700">
                                    {{ $appointment['duration'] ?: 0 }} minutos

                                </span>
                            </div>


                        </div>

                        <hr class="my-3">
                        <div class="space-y-6">
                            @if (!$appointmentEdit && !auth()->user()->hasRole('Trabajador'))
                                <x-wire-select label="Trabajador" placeholder="seleccione un trabajador"
                                    :async-data="route('api.plantillas.index')" wire:model="appointment.plantilla_id" :disabled="isset($appointmentEdit)"
                                    option-label="name" option-value="id" />
                            @endif

                            <x-wire-textarea label="Motivo a Tratar" placeholder="Ingrese el Asunto a tratar"
                                wire:model="appointment.asunto" />
                            <Label>
                                Foto de Oficio
                            </Label>
                            <figure class="mb-4 relative">
                                <div class="absolute top-8 right-8">
                                    <label
                                        class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700">
                                        <i class="fas fa-camera mr-2"></i>
                                        Actualizar imagen
                                        <input type="file" class="hidden" accept="image/*"
                                            wire:model="appointment.image">
                                    </label>
                                </div>
                                <img class="aspect-[16/9]  object-center w-full"
                                    src="{{ $appointment['image'] ? $appointment['image']->temporaryUrl() : asset('img/no dispo.png') }}"
                                    alt="">
                            </figure>

                            <x-wire-button wire:click="save" spinner="save" class="w-full">
                                Confirmar cita
                            </x-wire-button>
                        </div>

                    </x-wire-card>
                </div>

            </div>
        @else
            <x-wire-card>
                <p>
                    No hay disponibilidad para la fecha y hora
                </p>
            </x-wire-card>

        @endif
    @endif

    @push('js')
        <script>
            function data() {
                return {
                    selectedSchedules: @entangle('selectedSchedules').live,
                    selectSchedule(funcionarioId, schedule) {

                        if (this.selectedSchedules.funcionario_id !== funcionarioId) {
                            this.selectedSchedules = {
                                funcionario_id: funcionarioId,
                                schedules: [schedule]
                            };
                            return;
                        }


                        let currentSchedules = this.selectedSchedules.schedules;
                        let newSchedules = [];

                        if (currentSchedules.includes(schedule)) {
                            newSchedules = currentSchedules.filter(s => s !== schedule);
                        } else {
                            newSchedules = [...currentSchedules, schedule];
                        }

                        if (this.isContiguous(newSchedules)) {
                            this.selectedSchedules = {
                                funcionario_id: funcionarioId,
                                schedules: newSchedules
                            };
                        } else {
                            this.selectedSchedules = {
                                funcionario_id: funcionarioId,
                                schedules: [schedule]
                            };
                        }
                    },
                    isContiguous(schedules) {
                        if (schedules.lenght < 2) {
                            return true;
                        }

                        let sortedSchedules = schedules.sort();

                        for (let i = 0; i < sortedSchedules.lenght - 1; i++) {
                            let currentTime = sortedSchedules[i];
                            let nextTime = sortedSchedules[i + 1];

                            if (this.calculateNextTime(currentTime) !== nextTime) {
                                return false;
                            }
                        }

                        return true;
                    },
                    calculateNextTime(time) {
                        let date = new Date(`1970-01-01T${time}`);

                        let duration = parseInt("{{ config('schedule.apointment_duration') }}");

                        date.setMinutes(date.getMinutes() + duration);
                        return date.toTimeString().split(' ')[0];
                    }
                }
            }
        </script>
    @endpush

</div>
