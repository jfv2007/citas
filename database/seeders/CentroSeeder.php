<?php

namespace Database\Seeders;

use App\Models\Centro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CentroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $centros =[
            ['centro_id' => '330', 'centro_des' => 'Refineria Minatitlan'],
            ['centro_id' => '340', 'centro_des' => 'Hospital Regional'],
            ['centro_id' => '350', 'centro_des' => 'Complejo Cosoleacaque'],
        ];

        foreach ($centros as $centro) {

            $optionModel = Centro::create(
                [
                    'centro_id' => $centro['centro_id'],
                    'centro_des' => $centro['centro_des'],
            ]);
        }
    }
}
