<div>
    <div class="lg:flex lg:justify-between lg:items-center mb-4">

{{--         <div class="flex items-center space-x-5">
            <img src="{{ $appointment->plantilla->user->profile_photo_url }}"
                class="h-20 w-20 rounded-full object-cover object-center" alt="{{ $appointment->plantilla->user->name }}"> --}}
            <div>
                <p class="text-2xl font-bold text-gray-900">
                    {{ $appointment->plantilla->user->name }}
                </p>
            </div>
        {{-- </div> --}}


        <div class="lg:flex lg:space-x-3  space-y-2 lg:space-y-0 mt-4 lg:mt-0">
            <x-wire-button class="w-full lg:w-auto" outline gray sm x-on:click="$openModal('historyModal')">
                <i class="fa-solid fa-notes-medical"></i>
                Ver Historial
            </x-wire-button>

            <x-wire-button class="w-full lg:w-auto" outline gray sm x-on:click="$openModal('previousConsultationsModal')">
                <i class="fa-solid fa-clock-rotate-left"></i>
                Consultas Anteriores
            </x-wire-button>
        </div>
    </div>



    <x-wire-card>
        {{-- Tabs --}}
        <x-tabs active="reunion">
            <x-slot name="header">
                <x-tab-link tab="reunion">
                    <i class=" fa-solid fa-notes-medical me-2"></i>
                    Reunion
                </x-tab-link>
                <x-tab-link tab="Imagenes">
                    <i class="fa-solid fa-prescription-bottle-medical me-2"></i>
                    Imagenes de Oficios
                </x-tab-link>
            </x-slot>


            {{--  --}}
            <x-tab-contect tab="reunion">
                <div class="space-y-4">
                    <x-wire-textarea label="Informe del Asunto del Trabajador" placeholder="Describa el diagnostico del paciente aqui.."
                        wire:model="form.diagnosis" />

                    <x-wire-textarea label="Exposicion del Asunto por el Funcionario" placeholder="Describa el tratamiento del paciente aqui.."
                        wire:model="form.treatment" />

                    <x-wire-textarea label="Notas de la reunion" placeholder="Agrege notas adicionales aca.."
                        wire:model="form.notes" />

                </div>

            </x-tab-contect>

            {{-- datos-centro --}}
            <x-tab-contect tab="Imagenes">
                <div class="space-y-4">

                    <div class="form-group">

                                 <div class="w-full">
                                    <div class="flex">
                                        @if ($images)
                                            Photo Preview:
                                            <div class="flex bg-blue-200 p-4 rounded-lg">
                                                @foreach ($images as $image)
                                                    <img class="img-fluid img-thumbnail" style="width:150px;"
                                                        src="{{ $image->temporaryUrl() }}">
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <label for="">Images</label>
                                <input type="file" class="form-control" style="padding: 3px; font-size: 12px;" wire:model="images" multiple />
                                @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                    {{-- @forelse ($form['prescriptions'] as $index => $prescription)
                        <div class="bg-gray-50 p-4 rounded-lg border lg:flex gap-4 space-y-4 lg:space-x-0"
                            wire:key="prescription-{{ $index }}">


                            <div class="flex-1">
                                <x-wire-input label="Medicamento" placeholder="Ej: Amoxicilina 500mg"
                                    wire:model="form.prescriptions.{{ $index }}.medicine" />

                            </div>

                            <div class="lg:w-32">
                                <x-wire-input label="Dosis" placeholder="Ej: 1 cap"
                                    wire:model="form.prescriptions.{{ $index }}.dosage" />
                            </div>

                            <div class="flex-1">
                                <x-wire-input label="Frecuencia / Duracion" placeholder="Ej: cada 8 horas por 7 dias"
                                    wire:model="form.prescriptions.{{ $index }}.frequency" />
                            </div>

                            <div class="flex-shrink-0 lg:pt-6.5">
                                <x-wire-mini-button sm red icon="trash"
                                    wire:click="removePrescription({{ $index }})"
                                    spinner="removePrescription({{ $index }})" />

                            </div>

                        </div>
                    @empty
                        <div class="text-center text-gray-500 py-6">
                            No hay medicamentos añadidos a la receta
                        </div>
                    @endforelse --}}
                </div>


                {{-- <div class="mt-4">
                    <x-wire-button outline secondary wire:click="addPrescription" spinner="addPrescription">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Añadir Medicamento
                    </x-wire-button>
                </div> --}}

            </x-tab-contect>

            <div class="flex justify-end mt-6">
                <x-wire-button wire:click="save" spinner="save"
                    :disabled="!$appointment->status->isEditable()">
                    <i class="fa-solid fa-save mr-2"></i>
                    Guardar consulta
                </x-wire-button>

            </div>
        </x-tabs>
    </x-wire-card>

    <x-wire-modal-card title="Historia del trabajador" name="historyModal" width="5xl">

        <div class="grid lg:grid-cols-4 gap-6">
            <div>
                <p class="font-medium text-gray-500 mb-1">
                    Telefono
                </p>
                <p class="font-semibold text-gray-800">
                    {{ $plantilla->user->phone ?? 'No registrado' }}
                </p>


                <p class="font-medium text-gray-500 mb-1">
                    Centro de trabajo
                </p>
                <p class="font-semibold text-gray-800">
                    {{ $plantilla->centro->centro_des ?? 'No registrado' }}
                </p>

            </div>

            <div>
                <p class="font-medium text-gray-500 mb-1">
                    Situacion Contractual
                </p>
                <p class="font-semibold text-gray-800">
                    {{ $plantilla->situacionc ?? 'No registrado' }}
                </p>
                <p class="font-medium text-gray-500 mb-1">
                    Departamento
                </p>
                <p class="font-semibold text-gray-800">
                    {{ $plantilla->depto->depto_des ?? 'No registrado' }}
                </p>

            </div>

            <div>
                <p class="font-medium text-gray-500 mb-1">
                    Contacto de emergencia
                </p>
                <p class="font-semibold text-gray-800">
                    {{ $plantilla->c_emergencia ?? 'No registrado' }}
                </p>

                <p class="font-medium text-gray-500 mb-1">
                    Direccion
                </p>
                <p class="font-semibold text-gray-800">
                    {{ $plantilla->user->address ?? 'No registrado' }}
                </p>
            </div>
        </div>

        <x-slot name=footer>
            <div class="flex justify-end">
                <a href="{{ route('admin.plantillas.edit', $plantilla->id) }}"
                    class="font-semibold text-blue-600 hover:text-blue-800" target="_blank">
                    Ver/ Editar datos del trabajador
                </a>

            </div>
        </x-slot>

    </x-wire-modal-card>

    <x-wire-modal-card title="Consultas anteriores" name="previousConsultationsModal" width="5xl">

        @forelse ($previousConsultations as $consultation)
            <a href="{{ route('admin.appointments.show', $consultation->appointment_id) }}"
                class="block p-5 rounded-lg shadow-md border-gray-200 hover:border-indigo-400 hover:shadow-indigo-100 transition-all duration-200"
                target="_blank">

                <div class="lg:flex justify-between items-center space-y-2 lg:space-y-0">
                    <div>
                        <p class="font-semibold text-gray-800 flex items-center">
                            <i class="fa-solid fa-calendar-days text-gray-500 mr-2"></i>
                            {{ $consultation->appointment->date->format('d/m/Y H:i') }}
                        </p>
                        <p>
                            Atendido por :
                            Funcionario {{ $consultation->appointment->funcionario->user->name }}
                        </p>
                    </div>


                    <div>
                        <x-wire-button class="w-full lg:w-auto">
                            Ver detalles
                        </x-wire-button>

                    </div>
                </div>



            </a>

        @empty
            <div class="text-center py-10 rounded-xl border border-dashed">
                <i class="fa-solid fa-inbox text-4xl text-gray-300"></i>

                <p class="mt-4 text-sm font-medium text-gray-500">
                    No se encontro consulta anterior para este trabajador
                </p>
            </div>
        @endforelse

        <x-slot name=footer>
            <div class="flex justify-end">
                <x-wire-button outline gray sm x-on:click="$closeModal('previousConsultationsModal')">
                    Cerrar
                </x-wire-button>

            </div>
        </x-slot>

    </x-wire-modal-card>

</div>
