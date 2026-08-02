<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('requerimiento_id')
                ->nullable()
                ->constrained('requerimientos')
                ->nullOnDelete();

            $table->string('titulo');
            $table->text('mensaje');

            $table->boolean('leida')
                ->default(false);

            $table->timestamp('fecha_leida')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notificaciones');
    }
};