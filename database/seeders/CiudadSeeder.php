<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cuidads = [
            
            ['estado_id' => '30', 'clave' => '1', 'nombre' => 'Acajete', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '2', 'nombre' => 'Acatlán', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '3', 'nombre' => 'Acayucan', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '4', 'nombre' => 'Actopan', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '5', 'nombre' => 'Acula', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '6', 'nombre' => 'Acultzingo', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '7', 'nombre' => 'Camaron de Tejeda', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '8', 'nombre' => 'Alpatlahuac', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '9', 'nombre' => 'Alto Lucero de Gutiérrez Barrios', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '10', 'nombre' => 'Altotonga', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '11', 'nombre' => 'Alvarado', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '12', 'nombre' => 'Amatitlan', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '13', 'nombre' => 'Naranjos Amatlán', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '14', 'nombre' => 'AmatlÃ¡n de los Reyes', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '15', 'nombre' => 'Angel R. Cabada', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '16', 'nombre' => 'La Antigua', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '17', 'nombre' => 'Apazapan', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '18', 'nombre' => 'Aquila', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '19', 'nombre' => 'Astacinga', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '20', 'nombre' => 'Atlahuilco', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '21', 'nombre' => 'Atoyac', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '22', 'nombre' => 'Atzacan', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '23', 'nombre' => 'Atzalan', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '24', 'nombre' => 'Tlaltetela', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '25', 'nombre' => 'Ayahualulco', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '26', 'nombre' => 'Banderilla', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '27', 'nombre' => 'Benito Juárez', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '28', 'nombre' => 'Boca del Río', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '29', 'nombre' => 'Calcahualco', 'activo'=>'1'],
            ['estado_id' => '30', 'clave' => '30', 'nombre' => 'Camerino Z. Mendoza', 'activo'=>'1'],
           
        ];

        foreach ($cuidads as $cuidad) {
            $optionModel = Ciudad ::create(
                [
                    'estado_id' => $cuidad['estado_id'],
                    'clave' => $cuidad['clave'],
                    'nombre' => $cuidad['nombre'],
                    'activo' => $cuidad['activo'],
                ]
            );
        }
    }
}
