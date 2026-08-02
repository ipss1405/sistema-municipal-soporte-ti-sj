<?php

namespace Database\Seeders;

use App\Models\Requerimiento;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Poblar la base de datos con usuarios
     * y requerimientos de prueba.
     */
    public function run(): void
    {
        /*
         * Cuenta administradora para pruebas.
         */
        User::factory()->create([
            'name' => 'Rosa Administradora',
            'email' => 'rosa@sanjoaquin.cl',
            'password' => 'Municipal2026!',
            'rol' => 'administrador',
        ]);

        /*
         * Funcionarios municipales de prueba.
         */
        $funcionarios = [
            User::factory()->create([
                'name' => 'Ana Martínez',
                'email' => 'ana.martinez@sanjoaquin.cl',
                'password' => 'Municipal2026!',
                'rol' => 'funcionario',
            ]),

            User::factory()->create([
                'name' => 'Carlos González',
                'email' => 'carlos.gonzalez@sanjoaquin.cl',
                'password' => 'Municipal2026!',
                'rol' => 'funcionario',
            ]),

            User::factory()->create([
                'name' => 'María López',
                'email' => 'maria.lopez@sanjoaquin.cl',
                'password' => 'Municipal2026!',
                'rol' => 'funcionario',
            ]),

            User::factory()->create([
                'name' => 'Pedro Ramírez',
                'email' => 'pedro.ramirez@sanjoaquin.cl',
                'password' => 'Municipal2026!',
                'rol' => 'funcionario',
            ]),

            User::factory()->create([
                'name' => 'Sofía Fernández',
                'email' => 'sofia.fernandez@sanjoaquin.cl',
                'password' => 'Municipal2026!',
                'rol' => 'funcionario',
            ]),
        ];

        /*
         * Cada funcionario recibe seis requerimientos.
         *
         * 5 funcionarios x 6 requerimientos = 30 registros.
         */
        foreach ($funcionarios as $funcionario) {
            Requerimiento::factory()
                ->count(6)
                ->create([
                    'user_id' => $funcionario->id,
                ]);
        }
    }
}