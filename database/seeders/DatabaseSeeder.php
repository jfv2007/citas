<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            BloodTypeSeeder::class,
            PermissionSeeder::class,

            CentroSeeder::class,
            DeptoSeeder::class,
            EstadoSeeder::class,
            CiudadSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PuestoSeeder::class,

        ]);


        User::factory()->create([
            'name' => 'Jesus Feria',
            'ficha'=>'454455',
            'email' => 'jfv6@hotmail.com',
            'password' => bcrypt('12345678'),
            /* 'dni' => 'Oficial Mayor', */
            'phone' => '600123456',
            'address' => 'Calle Falsa 123',
        ])->assignRole('admin');
    }
}
