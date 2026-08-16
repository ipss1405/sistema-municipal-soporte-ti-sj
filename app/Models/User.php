<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'rol',
])]
#[Hidden([
    'password',
    'remember_token',
])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Requerimientos creados por el funcionario.
     */
    public function requerimientos(): HasMany
    {
        return $this->hasMany(
            Requerimiento::class,
            'user_id'
        );
    }

    /**
     * Requerimientos asignados al usuario
     * cuando cumple el rol de técnico TI.
     */
    public function requerimientosAsignados(): HasMany
    {
        return $this->hasMany(
            Requerimiento::class,
            'tecnico_id'
        );
    }

    /**
     * Derivaciones realizadas por el usuario
     * cuando cumple el rol de administrador.
     */
    public function asignacionesRealizadas(): HasMany
    {
        return $this->hasMany(
            Requerimiento::class,
            'asignado_por_id'
        );
    }

    /**
     * Un usuario puede tener muchas notificaciones.
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
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}