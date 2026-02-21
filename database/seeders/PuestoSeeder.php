<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $puestos =[
            'Secretario General',
            'Oficial Mayor',
            'Secretario del interor y acuerdos',
            'Secretario del exterior y propaganda',
            'Secretario Tesoreria',
            'Secretario de Organizaciony estadistica',
            'Consejo local de vigilanca- Presidente',
            'Comision de Honor y Justicia- Presidente',
            'Secretario de ajustes y asuntos legales',
        ];

        foreach ($puestos as $puesto) {
            \App\Models\Puesto::create([
                'name'=> $puesto
            ]);
        }

    }
}
