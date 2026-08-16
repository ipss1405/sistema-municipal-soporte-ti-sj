<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TecnicosSeeder extends Seeder
{
    /**
     * Crea o actualiza los usuarios
     * correspondientes al equipo técnico TI.
     */
    public function run(): void
    {
        $tecnicos = [
            [
                'name' => 'Gabriel Silva',
                'email' => 'gabrielsilva@sanjoaquin.cl',
            ],
            [
                'name' => 'David Guajardo',
                'email' => 'davidguajardo@sanjoaquin.cl',
            ],
            [
                'name' => 'Carlos Saavedra',
                'email' => 'carlossaavedra@sanjoaquin.cl',
            ],
            [
                'name' => 'Alejandro Adio',
                'email' => 'alejandroadio@sanjoaquin.cl',
            ],
        ];

        foreach ($tecnicos as $tecnico) {
            User::updateOrCreate(
                [
                    'email' => $tecnico['email'],
                ],
                [
                    'name' => $tecnico['name'],
                    'password' => 'Municipal2026!',
                    'rol' => 'tecnico',
                ]
            );
        }
    }
}