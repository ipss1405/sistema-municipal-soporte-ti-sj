<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cambia el valor predeterminado de la prioridad
     * para los nuevos requerimientos.
     */
    public function up(): void
    {
        Schema::table('requerimientos', function (Blueprint $table) {
            $table->string('prioridad')
                ->default('sin_asignar')
                ->change();
        });
    }

    /**
     * Revierte el cambio y vuelve al valor
     * predeterminado utilizado anteriormente.
     */
    public function down(): void
    {
        Schema::table('requerimientos', function (Blueprint $table) {
            $table->string('prioridad')
                ->default('media')
                ->change();
        });
    }
};