<?php

namespace App\Enums;

enum AppointmentEnum:int
{

    case SCHEDULED = 1;
    case COMPLETED = 2;
    case CANCELLED = 3;

    public function label()
    {
        return match($this) {
            self::SCHEDULED=>'Programado',
            self::COMPLETED => 'Completado',
            self::CANCELLED => 'Cancelado',
        };
    }

    public function color()
    {
        return match ($this) {
            self::SCHEDULED => 'blue',
            self::COMPLETED => 'green',
            self::CANCELLED => 'red',
        };
    }

    public function colorHex()
    {
        return match ($this) {
            self::SCHEDULED => '#007bff',
            self::COMPLETED => '#28a745',
            self::CANCELLED => '#dc3545',
        };
    }

    public function isEditable()
    {
        return $this ===self::SCHEDULED;
    }

}
