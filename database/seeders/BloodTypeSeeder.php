<?php

namespace Database\Seeders;

use App\Models\BlodeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodTypes =[
            'A+',
            'A-',
            'B+',
            'AB+',
            'AB-',
            'O+',
            'O-',
        ];

        foreach ($bloodTypes as $type) {
            BlodeType::create(['name' => $type]);
        }
    }
}
