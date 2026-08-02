<?php

namespace Database\Factories;

use App\Models\Requerimiento;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Requerimiento>
 */
class RequerimientoFactory extends Factory
{
    /**
     * Modelo asociado a esta Factory.
     *
     * @var class-string<Requerimiento>
     */
    protected $model = Requerimiento::class;

    /**
     * Define los datos ficticios de un requerimiento.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoria = fake()->randomElement([
            'computador',
            'correo',
            'internet',
            'impresora',
            'sistema',
            'firma',
            'usuario',
            'otro',
        ]);

        $estado = fake()->randomElement([
            'pendiente',
            'en_revision',
            'en_proceso',
            'resuelto',
            'cerrado',
            'rechazado',
        ]);

        $titulosPorCategoria = [
            'computador' => [
                'Equipo no enciende',
                'Computador funciona lentamente',
                'Problema con pantalla del equipo',
                'Solicitud de revisión de computador',
            ],

            'correo' => [
                'No puedo ingresar al correo institucional',
                'Problema para enviar correos',
                'Correo institucional bloqueado',
                'Solicitud de recuperación de contraseña',
            ],

            'internet' => [
                'Sin conexión a Internet',
                'Conexión de red inestable',
                'No hay acceso a la red municipal',
                'Problema con punto de red',
            ],

            'impresora' => [
                'Impresora no responde',
                'Problema al imprimir documentos',
                'Impresora sin conexión',
                'Solicitud de revisión de impresora',
            ],

            'sistema' => [
                'Error al ingresar al sistema municipal',
                'Sistema municipal no carga',
                'Problema al guardar información',
                'Solicitud de acceso al sistema',
            ],

            'firma' => [
                'Problema con firma electrónica',
                'Certificado de firma no funciona',
                'No puedo firmar un documento',
                'Solicitud de configuración de firma',
            ],

            'usuario' => [
                'Usuario bloqueado',
                'Solicitud de cambio de contraseña',
                'Problema con credenciales de acceso',
                'Solicitud de creación de usuario',
            ],

            'otro' => [
                'Solicitud de soporte informático',
                'Problema técnico general',
                'Solicitud de revisión de equipo',
                'Consulta al área de informática',
            ],
        ];

        $fechaCreacion = fake()->dateTimeBetween(
            '-3 months',
            'now'
        );

        $estaFinalizado = in_array(
            $estado,
            ['resuelto', 'cerrado'],
            true
        );

        $requiereRespuesta = in_array(
            $estado,
            [
                'en_revision',
                'en_proceso',
                'resuelto',
                'cerrado',
                'rechazado',
            ],
            true
        );

        return [
            /*
             * Si la Factory se utiliza sola, crea un usuario.
             * En el Seeder reemplazaremos este usuario por
             * funcionarios específicos.
             */
            'user_id' => User::factory(),

            'categoria' => $categoria,

            'titulo' => fake()->randomElement(
                $titulosPorCategoria[$categoria]
            ),

            'descripcion' => fake()->paragraph(2),

            'prioridad' => fake()->randomElement([
                'baja',
                'media',
                'alta',
                'urgente',
            ]),

            'estado' => $estado,

            'respuesta_admin' => $requiereRespuesta
                ? fake()->sentence(12)
                : null,

            'fecha_cierre' => $estaFinalizado
                ? fake()->dateTimeBetween(
                    $fechaCreacion,
                    'now'
                )
                : null,

            'created_at' => $fechaCreacion,

            'updated_at' => fake()->dateTimeBetween(
                $fechaCreacion,
                'now'
            ),
        ];
    }
}