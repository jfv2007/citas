<?php

return [
    [   'type' => 'link',
        'icon' => 'fa-solid fa-gauge',
        'title' => 'Dashboard',
        'route' => 'admin.dashboard',
        'active' => 'admin.dashboard',
        'can' => ['access_dashboard']
    ],
    [   'type' => 'header',
        'title' => 'Gestion',
        'can' => [
            'read_role',
            'read_user',
            'read_plantilla',
            'read_funcionario',
            'read_appointment',
            'read_calendar'
            ]
    ],
    [
        'type' => 'link',
        'icon' => 'fa-solid fa-shield-halved',
        'title' => 'Roles y Permisos',
        'route' => 'admin.roles.index',
        'active' => 'admin.roles.*',
        'can' => [
            'read_role'
            ]
    ],
    [
        'type' => 'link',
        'icon' => 'fa-solid fa-users',
        'title' => 'Usuarios',
        'route' => 'admin.users.index',
        'active' => 'admin.users.*',
        'can' => [
            'read_user',
        ]
    ],
    [
        'type' => 'link',
        'icon' => 'fa-solid fa-user-injured',
        'title' => 'Plantilla',
        'route' => 'admin.plantillas.index',
        'active' => 'admin.plantillas.*',
        'can' => [
            'read_plantilla'
        ]
    ],
    [
        'type' => 'link',
        'icon' => 'fa-solid fa-user-doctor',
        'title' => 'Funcionarios',
        'route' => 'admin.funcionarios.index',
        'active' => 'admin.funcionarios.*',
        'can' => [
            'read_funcionario'
        ]
    ],
    [
        'type' => 'link',
        'icon' => 'fa-solid fa-calendar-check',
        'title' => 'Citas Funcionarios',
        'route' => 'admin.appointments.index',
        'active' => 'admin.appointments.*',
        'can' => [
            'read_appointment'
        ]
    ],
    [
        'type' => 'link',
        'icon' => 'fa-solid fa-calendar-days',
        'title' => 'Calendario',
        'route' => 'admin.calendar.index',
        'active' => 'admin.calendar.*',
        'can' => [
            'read_calendar'
        ]
    ],
];
