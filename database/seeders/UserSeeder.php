<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Omar Feria',
            'ficha' => '454456',
            /* 'dni'=> '85967412', */
            'phone' => '9221535142',
            'address' => 'PENSADOR MEXICANO #32',
            'email' => 'jfv61978@gmail.com',
            'password' => bcrypt('12345678'),
        ])->assignRole('Funcionario');
    }
}
