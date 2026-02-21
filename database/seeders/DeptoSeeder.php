<?php

namespace Database\Seeders;

use App\Models\Depto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeptoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deptos = [
            ['depto_id' => '11715', 'depto_des' => 'SUPERINTENDENCIA DE OPERACIÓN SECTOR 3'],
            ['depto_id' => '11757', 'depto_des' => 'PLANTA DE ALQUILACIÓN 1 Y 2'],
            ['depto_id' => '11768', 'depto_des' => 'PTA HIDRODESULF DE NAFTAS DE COQUIZADORA'],
            ['depto_id' => '11792', 'depto_des' => 'TALLER MECÁNICO'],
            ['depto_id' => '11786', 'depto_des' => 'TRANSPORTACIÓN'],
            ['depto_id' => '11723', 'depto_des' => 'SUPCIA. DE GESTIÓN DEL MANTENIMIENTO'],
            ['depto_id' => '11736', 'depto_des' => 'PLANTA DE AZUFRE 2'],
            ['depto_id' => '11793', 'depto_des' => 'TALLER DE ALBAÑILERÍA'],
            ['depto_id' => '11767', 'depto_des' => 'PLANTA HIDRODESULFURADORA DE GASOLEOS'],
            ['depto_id' => '11785', 'depto_des' => 'TALLER ELÉCTRICO'],
            ['depto_id' => '11774', 'depto_des' => 'PLANTA COQUIZADORA'],
            ['depto_id' => '11749', 'depto_des' => 'PLANTA REFORMADORA DE NAFTA (GAS) NO.2'],
            ['depto_id' => '11726', 'depto_des' => 'BOMBEOS Y ALMACENAMIENTO'],
            ['depto_id' => '11782', 'depto_des' => 'PATIO Y MANIOBRAS'],
            ['depto_id' => '11787', 'depto_des' => 'TALLER DE CAMBIADORES DE CALOR'],
            ['depto_id' => '11780', 'depto_des' => 'PLANTA CATALÍTICA 2'],
            ['depto_id' => '11700', 'depto_des' => 'GERENCIA DE REFINERÍA MINATITLÁN'],
            ['depto_id' => '11756', 'depto_des' => 'PLANTA PRIMARIA NO. 5'],
            ['depto_id' => '11788', 'depto_des' => 'TALLER DE SOLDADURA'],
            ['depto_id' => '11775', 'depto_des' => 'PLANTA DE AGUAS AMARGAS'],
            ['depto_id' => '11701', 'depto_des' => 'SUPERINTENDENCIA DE INSPECCIÓN TÉCNICA'],
            ['depto_id' => '11737', 'depto_des' => 'PLANTA COMBINADA MAYA'],
            ['depto_id' => '18342', 'depto_des' => 'CONTRA-INCENDIO'],
            ['depto_id' => '11791', 'depto_des' => 'TALLER DE COMBUSTIÓN INTERNA'],
            ['depto_id' => '11766', 'depto_des' => 'PLANTA PRIMARIA NO. 3'],
            ['depto_id' => '11714', 'depto_des' => 'SUPERINTENDENCIA DE OPERACIÓN SECTOR 2'],
            ['depto_id' => '11725', 'depto_des' => 'GENERACIÓN ELÉCTRICA'],
            ['depto_id' => '11738', 'depto_des' => 'PLANTA CATALíTICA 2'],
            ['depto_id' => '11796', 'depto_des' => 'LABORATORIO DE GASES'],
            ['depto_id' => '11706', 'depto_des' => 'GENERACIÓN VAPOR'],
            ['depto_id' => '11711', 'depto_des' => 'SUPCIA. DE PROGRAMACIÓN DE LA PRODUCCIÓN'],
            ['depto_id' => '11790', 'depto_des' => 'TALLER DE TUBERÍA'],
            ['depto_id' => '11769', 'depto_des' => 'PLANTA HIDRODESULFURADORA DE DIESEL'],
            ['depto_id' => '11789', 'depto_des' => 'TALLER DE PAILERÍA'],
            ['depto_id' => '11718', 'depto_des' => 'SUPERINTENDENCIA DE OPERACIÓN SECTOR 6'],
            ['depto_id' => '11712', 'depto_des' => 'SUPCIA. DE FUERZA Y SERV. PRINCIPALES'],
            ['depto_id' => '11733', 'depto_des' => 'SUPCIA. DE ASEG. DE LA CALIDAD DEL PROD. '],
            ['depto_id' => '11750', 'depto_des' => 'PTA. HIDRODESULF. DESTILADOS INTER. NO.3'],
            ['depto_id' => '11722', 'depto_des' => 'SUPCIA. DE INGRIA. DE CONF. Y MANTTO. '],
            ['depto_id' => '11730', 'depto_des' => 'SUBGCIA. DE INGRIA. DE PROC. Y MEJ. OPER'],
            ['depto_id' => '11795', 'depto_des' => 'TALLER DE CARPINTERÍA'],
            ['depto_id' => '11721', 'depto_des' => 'SUPCIA. DE PROGRAMACIÓN DE PAROS DE PTA'],
            ['depto_id' => '11720', 'depto_des' => 'SUBGCIA. DE CONFIABILIDAD Y MANTTO. '],
            ['depto_id' => '11794', 'depto_des' => 'TALLER DE PINTURA'],
            ['depto_id' => '11728', 'depto_des' => 'PLANTA CATALÍTICA NO. 1'],
            ['depto_id' => '11759', 'depto_des' => 'PLANTA COMBINADA MAYA'],
            ['depto_id' => '11724', 'depto_des' => 'SUPERINTENDENCIA DE OPERACIÓN SECTOR 8'],
            ['depto_id' => '11705', 'depto_des' => 'TRATAMIENTOS DE AGUA'],
            ['depto_id' => '11758', 'depto_des' => 'PLANTA CATALÍTICA 2'],
            ['depto_id' => '11746', 'depto_des' => 'PTA. DESULF. DE GASOL. CATAL. U. REG. A. '],
            ['depto_id' => '11784', 'depto_des' => 'TALLER DE INSTRUM. DE CTROL AUTOMATICO'],
            ['depto_id' => '11739', 'depto_des' => 'PLANTA PRIMARIA NO. 3'],
            ['depto_id' => '11709', 'depto_des' => 'FUERZA Y SERVICIOS PRINCIPALES 2'],
            ['depto_id' => '11719', 'depto_des' => 'SUPERINTENDENCIA DE OPERACIÓN SECTOR 7'],
            ['depto_id' => '11797', 'depto_des' => 'LABORATORIO EXPERIMENTAL'],
            ['depto_id' => '11798', 'depto_des' => 'LABORATORIO ANALÍTICO'],
            ['depto_id' => '11735', 'depto_des' => 'PLANTA DE AZUFRE NO. 1'],            
        ];

        foreach ($deptos as $depto) {

            $optionModel = Depto::create(
                [
                    'depto_id' => $depto['depto_id'],
                    'depto_des' => $depto['depto_des'],
                ]
            );
        }
    }
}
