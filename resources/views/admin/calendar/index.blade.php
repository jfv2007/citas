<x-admin-layout title="Citas | Citas" :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'href' => route('admin.dashboard'),
    ],
    [
        'name' => 'Calendario',
    ],
]">

    @push('css')
        <style>
            .fc-event {
                cursor: pointer;
            }
        </style>
    @endpush

    <div x-data="data()">


        <x-wire-modal-card title="Cita" name="appointmentModal" width="md" align="center">

            <div class="space-y-4" mb-4>
                <div>
                    <strong>Fecha y Hora </strong>
                    <span x-text="selectedEvent.dateTime"></span>
                </div>
                <div>
                    <strong>plantilla </strong>
                    <span x-text="selectedEvent.plantilla"></span>
                </div>
                <div>
                    <strong>Funcionario </strong>
                    <span x-text="selectedEvent.funcionario"></span>
                </div>
                <div>
                    <strong>Estado </strong>
                    <span x-text="selectedEvent.status"></span>
                </div>


            </div>

            <a x-bind:href="selectedEvent.url" class="w-full">
                <x-wire-button class="w-full">
                    Gestionar cita
                </x-wire-button>
            </a>
        </x-wire-modal-card>

        <div x-ref='calendar'>

        </div>
    </div>



    @push('js')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.20/index.global.min.js'></script>

        <script>
            function data() {
                return {
                    selectedEvent: {
                        dateTime: null,
                        plantilla: null,
                        funcionario: null,
                        status: null,
                        color: null,
                        url: null,
                    },
                    openModal(info) {
                        this.selectedEvent = {
                            dateTime: info.event.extendedProps.dateTime,
                            plantilla: info.event.extendedProps.plantilla,
                            funcionario: info.event.extendedProps.funcionario,
                            status: info.event.extendedProps.status,
                            /*  color: infor.event.extendedProps.color, */
                            url: info.event.extendedProps.url,
                        };
                         /* console.log(this.selectedEvent);  */
                        $openModal('appointmentModal');
                    },


                    init() {
                        var calendarEl = this.$refs.calendar;
                        var calendar = new FullCalendar.Calendar(calendarEl, {

                            headerToolbar: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                            },
                            local: 'es',

                            buttonText: {
                                today: 'Hoy',
                                month: 'Mes',
                                week: 'Semana',
                                day: 'Dia',
                                list: 'lista'
                            },

                            allDayText: 'Todo el dia',
                            noEventsText: 'No hay eventos',

                            /* initialView: 'dayGridMonth' */
                            initialView: 'timeGridWeek',

                            slotDuration: '00:15:00',

                            slotMinTime: '08:00:00',
                            slotMaxTime: '20:00:00',



                            events: {
                                url: "{{ route('api.appointments.index') }}",
                                failure: function() {
                                    alert('Hubo un error al cargar los eventos.');
                                }
                            },
                            eventClick: (info) => this.openModal(info),

                            scrollTime: "{{ date('H:i:s') }}",
                        });
                        calendar.render();
                    }
                }
            }
        </script>
    @endpush

</x-admin-layout>
