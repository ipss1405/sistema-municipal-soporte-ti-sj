<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Agrega la información necesaria para
     * derivar un requerimiento a un técnico TI.
     */
    public function up(): void
    {
        Schema::table('requerimientos', function (Blueprint $table) {

            /*
             * Técnico responsable del requerimiento.
             */
            $table->foreignId('tecnico_id')
                ->nullable()
                ->after('estado')
                ->constrained('users')
                ->nullOnDelete();

            /*
             * Administrador que realizó la derivación.
             */
            $table->foreignId('asignado_por_id')
                ->nullable()
                ->after('tecnico_id')
                ->constrained('users')
                ->nullOnDelete();

            /*
             * Fecha y hora en que se realizó
             * la asignación al técnico.
             */
            $table->timestamp('fecha_asignacion')
                ->nullable()
                ->after('asignado_por_id');

            /*
             * Trabajo o acción que debe realizar
             * el técnico responsable.
             */
            $table->text('tarea_asignada')
                ->nullable()
                ->after('fecha_asignacion');
        });
    }

    /**
     * Revierte los campos de derivación.
     */
    public function down(): void
    {
        Schema::table('requerimientos', function (Blueprint $table) {

            $table->dropConstrainedForeignId('tecnico_id');

            $table->dropConstrainedForeignId('asignado_por_id');

            $table->dropColumn([
                'fecha_asignacion',
                'tarea_asignada',
            ]);
        });
    }
};