<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Admin oficial del proyecto
        User::factory()->create([
            'name' => 'Admin Tienda',
            'email' => 'admin@tienda.com',
            'is_admin' => true,
        ]);

        // Usuario Demo
        User::factory()->create([
            'name' => 'Usuario Demo',
            'email' => 'demo@example.com',
            'is_admin' => true,
        ]);

        // Tu usuario personalizado (Usuario Normal)
        User::factory()->create([
            'name' => 'Mi Usuario',
            'email' => 'tu@email.com',
            'is_admin' => false,
        ]);

        // Crear usuarios adicionales con datos aleatorios
        User::factory(2)->create();
    }
}
