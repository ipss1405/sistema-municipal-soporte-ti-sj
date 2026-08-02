<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notificacion extends Model
{
    use HasFactory;

    protected $table = 'notificaciones';

    protected $fillable = [
        'user_id',
        'requerimiento_id',
        'titulo',
        'mensaje',
        'leida',
        'fecha_leida',
    ];

    /**
     * Una notificación pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Una notificación puede pertenecer a un requerimiento.
     */
    public function requerimiento(): BelongsTo
    {
        return $this->belongsTo(
            Requerimiento::class,
            'requerimiento_id'
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
            'leida' => 'boolean',
            'fecha_leida' => 'datetime',
        ];
    }
}