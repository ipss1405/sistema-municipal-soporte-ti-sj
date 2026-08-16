<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega los campos necesarios para registrar
     * la gestión realizada por el área técnica.
     */
    public function up(): void
    {
        Schema::table('requerimientos', function (Blueprint $table) {

            /*
             * Descripción del avance o trabajo realizado
             * por el técnico o administrador.
             */
            $table->text('avance_tecnico')
                ->nullable()
                ->after('tarea_asignada');

            /*
             * Indica si para resolver el requerimiento
             * es necesario conseguir materiales o repuestos.
             */
            $table->boolean('requiere_materiales')
                ->default(false)
                ->after('avance_tecnico');

            /*
             * Detalle de los materiales o repuestos
             * necesarios para continuar la atención.
             */
            $table->text('materiales_requeridos')
                ->nullable()
                ->after('requiere_materiales');

            /*
             * Tiempo estimado informado para continuar
             * o finalizar la atención.
             *
             * Ejemplos:
             * "2 días hábiles"
             * "Durante la tarde"
             * "Pendiente de proveedor"
             */
            $table->string('tiempo_estimado')
                ->nullable()
                ->after('materiales_requeridos');
        });
    }

    /**
     * Revierte los campos de gestión técnica.
     */
    public function down(): void
    {
        Schema::table('requerimientos', function (Blueprint $table) {

            $table->dropColumn([
                'avance_tecnico',
                'requiere_materiales',
                'materiales_requeridos',
                'tiempo_estimado',
            ]);
        });
    }
};