<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Requerimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'categoria',
        'titulo',
        'descripcion',
        'prioridad',
        'estado',

        /*
         * Datos de derivación TI.
         */
        'tecnico_id',
        'asignado_por_id',
        'fecha_asignacion',
        'tarea_asignada',

        'respuesta_admin',
        'fecha_cierre',
    ];

    /**
     * Funcionario que creó el requerimiento.
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /**
     * Técnico TI responsable del requerimiento.
     */
    public function tecnico(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'tecnico_id'
        );
    }

    /**
     * Administrador que realizó la asignación
     * del requerimiento al técnico.
     */
    public function asignadoPor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'asignado_por_id'
        );
    }

    /**
     * Un requerimiento puede generar muchas notificaciones.
     */
    public function notificaciones(): HasMany
    {
        return $this->hasMany(
            Notificacion::class
        );
    }

    /**
     * Conversión automática de atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'fecha_asignacion' => 'datetime',
            'fecha_cierre' => 'datetime',
        ];
    }
}