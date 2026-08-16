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
     * Poblar la base de datos con usuarios,
     * técnicos TI y requerimientos de prueba.
     */
    public function run(): void
    {
        /*
         * Cuenta administradora para pruebas.
         *
         * updateOrCreate evita duplicar el usuario
         * si el Seeder se ejecuta nuevamente.
         */
        User::updateOrCreate(
            [
                'email' => 'rosa@sanjoaquin.cl',
            ],
            [
                'name' => 'Rosa Administradora',
                'password' => 'Municipal2026!',
                'rol' => 'administrador',
            ]
        );

        /*
         * Funcionarios municipales de prueba.
         */
        $datosFuncionarios = [
            [
                'name' => 'Ana Martínez',
                'email' => 'ana.martinez@sanjoaquin.cl',
            ],
            [
                'name' => 'Carlos González',
                'email' => 'carlos.gonzalez@sanjoaquin.cl',
            ],
            [
                'name' => 'María López',
                'email' => 'maria.lopez@sanjoaquin.cl',
            ],
            [
                'name' => 'Pedro Ramírez',
                'email' => 'pedro.ramirez@sanjoaquin.cl',
            ],
            [
                'name' => 'Sofía Fernández',
                'email' => 'sofia.fernandez@sanjoaquin.cl',
            ],
        ];

        $funcionarios = [];

        foreach ($datosFuncionarios as $datos) {
            $funcionarios[] = User::updateOrCreate(
                [
                    'email' => $datos['email'],
                ],
                [
                    'name' => $datos['name'],
                    'password' => 'Municipal2026!',
                    'rol' => 'funcionario',
                ]
            );
        }

        /*
         * Crear los técnicos del área TI.
         */
        $this->call([
            TecnicosSeeder::class,
        ]);

        /*
         * Cada funcionario recibe seis requerimientos
         * solamente si todavía no tiene requerimientos.
         *
         * Esto evita crear otros 30 registros
         * al ejecutar nuevamente el Seeder.
         */
        foreach ($funcionarios as $funcionario) {

            $tieneRequerimientos = Requerimiento::where(
                'user_id',
                $funcionario->id
            )->exists();

            if (!$tieneRequerimientos) {
                Requerimiento::factory()
                    ->count(6)
                    ->create([
                        'user_id' => $funcionario->id,
                    ]);
            }
        }
    }
}