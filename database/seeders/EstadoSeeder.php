<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estados = [
            ['clave'=>'1', 'nombre'=>'Aguascalientes', 'abrev'=>'Ags.', 'activo'=>'1'],
            ['clave'=>'2', 'nombre'=>'Baja California', 'abrev'=>'BC ', 'activo'=>'1'],
            ['clave'=>'3', 'nombre'=>'Baja California Sur', 'abrev'=>'BCS ', 'activo'=>'1'],
            ['clave'=>'4', 'nombre'=>'Campeche', 'abrev'=>'Camp. ', 'activo'=>'1'],
            ['clave'=>'5', 'nombre'=>'Coahuila de Zaragoza', 'abrev'=>'Coah.', 'activo'=>'1'],
            ['clave'=>'6', 'nombre'=>'Colima', 'abrev'=>'Col.', 'activo'=>'	1'],
            ['clave'=>'7', 'nombre'=>'Chiapas', 'abrev'=>'Chis.', 'activo'=>'1'],
            ['clave'=>'8', 'nombre'=>'Chihuahua', 'abrev'=>'Chih.', 'activo'=>'1'],
            ['clave'=>'9', 'nombre'=>'Ciudad de Mexico', 'abrev'=>'CDMX', 'activo'=>'1'],
            ['clave'=>'10', 'nombre'=>'Durango', 'abrev'=>'Dgo.', 'activo'=>'1'],
            ['clave'=>'11', 'nombre'=>'Guanajuato', 'abrev'=>'Gto.', 'activo'=>'1'],
            ['clave'=>'12', 'nombre'=>'Guerrero', 'abrev'=>'Gro.', 'activo'=>'1'],
            ['clave'=>'13', 'nombre'=>'Hidalgo', 'abrev'=>'Hgo.', 'activo'=>'1'],
            ['clave'=>'14', 'nombre'=>'Jalisco', 'abrev'=>'Jal.', 'activo'=>'1'],
            ['clave'=>'15', 'nombre'=>'Mexico', 'abrev'=>'Mex.', 'activo'=>'1'],
            ['clave'=>'16', 'nombre'=>'Michoacán de Ocampo', 'abrev'=>'Mich.', 'activo'=>'1'],
            ['clave'=>'17', 'nombre'=>'Morelos', 'abrev'=>'Mor.', 'activo'=>'1'],
            ['clave'=>'18', 'nombre'=>'Nayarit', 'abrev'=>'Nay.', 'activo'=>'1'],
            ['clave'=>'19', 'nombre'=>'Nuevo Leon', 'abrev'=>'NL', 'activo'=>'1'],
            ['clave'=>'20', 'nombre'=>'Oaxaca', 'abrev'=>'Oax.', 'activo'=>'1'],
            ['clave'=>'21', 'nombre'=>'Puebla', 'abrev'=>'Pue.', 'activo'=>'1'],
            ['clave'=>'22', 'nombre'=>'Querétaro', 'abrev'=>'Qro.', 'activo'=>'1'],
            ['clave'=>'23', 'nombre'=>'Quintana Roo', 'abrev'=>'Q. Roo', 'activo'=>'1'],
            ['clave'=>'24', 'nombre'=>'San Luis Potosí', 'abrev'=>'SLP', 'activo'=>'1'],
            ['clave'=>'25', 'nombre'=>'Sinaloa', 'abrev'=>'Sin.', 'activo'=>'1'],
            ['clave'=>'26', 'nombre'=>'Sonora', 'abrev'=>'Son.', 'activo'=>'1'],
            ['clave'=>'27', 'nombre'=>'Tabasco', 'abrev'=>'Tab.', 'activo'=>'1'],
            ['clave'=>'28', 'nombre'=>'Tamaulipas', 'abrev'=>'Tamps.', 'activo'=>'1'],
            ['clave'=>'29', 'nombre'=>'Tlaxcala', 'abrev'=>'Tlax.', 'activo'=>'1'],
            ['clave'=>'30', 'nombre'=>'Veracruz de Ignacio de la Llave', 'abrev'=>'Ver.', 'activo'=>'1'],
            ['clave'=>'31', 'nombre'=>'Yucatan', 'abrev'=>'Yuc.', 'activo'=>'1'],
            ['clave'=>'32', 'nombre'=>'Zacatecas', 'abrev'=>'Zac.', 'activo'=>'1'],
        ];

        foreach ($estados as $estado) {

            $optionModel = Estado::create(
                [
                    'clave' => $estado['clave'],
                    'nombre' => $estado['nombre'],
                    'abrev' => $estado['abrev'],
                    'activo' => $estado['activo'],
                ]
            );
        }
    }
    
}
