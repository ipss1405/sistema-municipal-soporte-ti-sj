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
         * Derivación TI
         */
        'tecnico_id',
        'asignado_por_id',
        'fecha_asignacion',
        'tarea_asignada',

        /*
         * Gestión técnica
         */
        'avance_tecnico',
        'requiere_materiales',
        'materiales_requeridos',
        'tiempo_estimado',

        /*
         * Respuesta y cierre
         */
        'respuesta_admin',
        'fecha_cierre',
    ];

    protected function casts(): array
    {
        return [
            'fecha_asignacion' => 'datetime',
            'fecha_cierre' => 'datetime',
            'requiere_materiales' => 'boolean',
        ];
    }

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
     * Administrador que realizó la asignación.
     */
    public function asignadoPor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'asignado_por_id'
        );
    }

    /**
     * Notificaciones asociadas al requerimiento.
     */
    public function notificaciones(): HasMany
    {
        return $this->hasMany(
            Notificacion::class,
            'requerimiento_id'
        );
    }
}