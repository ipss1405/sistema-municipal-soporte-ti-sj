<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Requerimiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TecnicoDashboardController extends Controller
{
    /**
     * Verifica que el usuario sea técnico.
     */
    private function verificarTecnico(): void
    {
        if (
            !Auth::check() ||
            Auth::user()->rol !== 'tecnico'
        ) {
            abort(
                403,
                'No tiene permisos para acceder al panel técnico.'
            );
        }
    }

    /**
     * Verifica que el requerimiento esté asignado
     * al técnico que inició sesión.
     */
    private function verificarAsignacion(
        Requerimiento $requerimiento
    ): void {
        $this->verificarTecnico();

        if ($requerimiento->tecnico_id !== Auth::id()) {
            abort(
                403,
                'Este requerimiento no está asignado a usted.'
            );
        }
    }

    /**
     * Mostrar el panel del técnico TI.
     */
    public function index()
    {
        $this->verificarTecnico();

        $tecnico = Auth::user();

        $requerimientos = Requerimiento::with('usuario')
            ->where('tecnico_id', $tecnico->id)
            ->orderByDesc('fecha_asignacion')
            ->orderByDesc('created_at')
            ->get();

        $total = $requerimientos->count();

        $pendientes = $requerimientos
            ->where('estado', 'pendiente')
            ->count();

        $enRevision = $requerimientos
            ->where('estado', 'en_revision')
            ->count();

        $enProceso = $requerimientos
            ->whereIn(
                'estado',
                [
                    'en_proceso',
                    'en_espera_materiales',
                    'en_espera_funcionario',
                ]
            )
            ->count();

        $resueltos = $requerimientos
            ->where('estado', 'resuelto')
            ->count();

        return view(
            'tecnico.dashboard',
            compact(
                'tecnico',
                'requerimientos',
                'total',
                'pendientes',
                'enRevision',
                'enProceso',
                'resueltos'
            )
        );
    }

    /**
     * Muestra el formulario para gestionar
     * un requerimiento asignado al técnico.
     */
    public function gestionar(
        Requerimiento $requerimiento
    ) {
        $this->verificarAsignacion(
            $requerimiento
        );

        $requerimiento->load([
            'usuario',
            'tecnico',
            'asignadoPor',
        ]);

        return view(
            'tecnico.gestionar',
            compact('requerimiento')
        );
    }

    /**
     * Guarda la gestión realizada por el técnico.
     */
    public function actualizarGestion(
        Request $request,
        Requerimiento $requerimiento
    ) {
        $this->verificarAsignacion(
            $requerimiento
        );

        $datos = $request->validate(
            [
                'estado' => [
                    'required',
                    'string',
                    'in:en_revision,en_proceso,en_espera_materiales,en_espera_funcionario,resuelto',
                ],

                'avance_tecnico' => [
                    'required',
                    'string',
                    'max:5000',
                ],

                'requiere_materiales' => [
                    'required',
                    'boolean',
                ],

                'materiales_requeridos' => [
                    'nullable',
                    'string',
                    'max:3000',
                ],

                'tiempo_estimado' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'respuesta_admin' => [
                    'nullable',
                    'string',
                    'max:5000',
                ],
            ],
            [
                'estado.required' =>
                    'Debe seleccionar el estado de atención.',

                'estado.in' =>
                    'El estado seleccionado no está permitido para el técnico.',

                'avance_tecnico.required' =>
                    'Debe registrar el avance o trabajo realizado.',

                'avance_tecnico.max' =>
                    'El avance técnico no puede superar los 5000 caracteres.',

                'requiere_materiales.required' =>
                    'Debe indicar si requiere materiales.',

                'materiales_requeridos.max' =>
                    'El detalle de materiales no puede superar los 3000 caracteres.',

                'tiempo_estimado.max' =>
                    'El tiempo estimado no puede superar los 255 caracteres.',

                'respuesta_admin.max' =>
                    'La información para el funcionario no puede superar los 5000 caracteres.',
            ]
        );

        /*
         * Si requiere materiales, debe indicar cuáles.
         */
        if (
            (bool) $datos['requiere_materiales'] &&
            empty(trim($datos['materiales_requeridos'] ?? ''))
        ) {
            return back()
                ->withErrors([
                    'materiales_requeridos' =>
                        'Debe indicar qué materiales o repuestos necesita.',
                ])
                ->withInput();
        }

        /*
         * Si ya no requiere materiales,
         * eliminamos el dato anterior.
         */
        $materialesRequeridos =
            (bool) $datos['requiere_materiales']
                ? $datos['materiales_requeridos']
                : null;

        /*
         * Guardar gestión técnica.
         */
        $requerimiento->update([
            'estado' =>
                $datos['estado'],

            'avance_tecnico' =>
                $datos['avance_tecnico'],

            'requiere_materiales' =>
                (bool) $datos['requiere_materiales'],

            'materiales_requeridos' =>
                $materialesRequeridos,

            'tiempo_estimado' =>
                $datos['tiempo_estimado'] ?? null,

            'respuesta_admin' =>
                $datos['respuesta_admin'] ?? null,
        ]);

        /*
         * Nombres visibles de los estados.
         */
        $nombresEstados = [
            'en_revision' =>
                'En revisión',

            'en_proceso' =>
                'En proceso',

            'en_espera_materiales' =>
                'En espera de materiales',

            'en_espera_funcionario' =>
                'En espera del funcionario',

            'resuelto' =>
                'Resuelto',
        ];

        $estadoVisible =
            $nombresEstados[$datos['estado']]
            ?? $datos['estado'];

        /*
         |--------------------------------------------------------------------------
         | NOTIFICACIÓN AL FUNCIONARIO
         |--------------------------------------------------------------------------
         |
         | El funcionario recibe información comprensible
         | sobre el estado de su solicitud.
         |
         */

        if ($requerimiento->user_id) {

            $mensajeFuncionario =
                'Su requerimiento N.º ' .
                $requerimiento->id .
                ' "' .
                $requerimiento->titulo .
                '" fue actualizado por el área de Informática. ' .
                'Estado: ' .
                $estadoVisible .
                '.';

            if (!empty($datos['respuesta_admin'])) {

                $mensajeFuncionario .=
                    ' Información: ' .
                    $datos['respuesta_admin'];
            }

            if (
                (bool) $datos['requiere_materiales'] &&
                !empty($materialesRequeridos)
            ) {
                $mensajeFuncionario .=
                    ' Material requerido: ' .
                    $materialesRequeridos .
                    '.';
            }

            if (!empty($datos['tiempo_estimado'])) {

                $mensajeFuncionario .=
                    ' Tiempo estimado: ' .
                    $datos['tiempo_estimado'] .
                    '.';
            }

            Notificacion::create([
                'user_id' =>
                    $requerimiento->user_id,

                'requerimiento_id' =>
                    $requerimiento->id,

                'titulo' =>
                    'Actualización de atención TI',

                'mensaje' =>
                    $mensajeFuncionario,

                'leida' =>
                    false,
            ]);
        }

        /*
         |--------------------------------------------------------------------------
         | NOTIFICACIÓN AL ADMINISTRADOR
         |--------------------------------------------------------------------------
         |
         | El administrador recibe información técnica
         | más completa sobre la gestión realizada.
         |
         */

        $administradores = User::where(
            'rol',
            'administrador'
        )->get();

        foreach ($administradores as $administrador) {

            $mensajeAdministrador =
                Auth::user()->name .
                ' actualizó el requerimiento N.º ' .
                $requerimiento->id .
                ' "' .
                $requerimiento->titulo .
                '". ' .
                'Estado: ' .
                $estadoVisible .
                '. ' .
                'Avance técnico: ' .
                $datos['avance_tecnico'] .
                '.';

            /*
             * Información de materiales.
             */
            if ((bool) $datos['requiere_materiales']) {

                $mensajeAdministrador .=
                    ' Requiere materiales: Sí.';

                if (!empty($materialesRequeridos)) {

                    $mensajeAdministrador .=
                        ' Material requerido: ' .
                        $materialesRequeridos .
                        '.';
                }

            } else {

                $mensajeAdministrador .=
                    ' Requiere materiales: No.';
            }

            /*
             * Tiempo estimado.
             */
            if (!empty($datos['tiempo_estimado'])) {

                $mensajeAdministrador .=
                    ' Tiempo estimado: ' .
                    $datos['tiempo_estimado'] .
                    '.';
            }

            Notificacion::create([
                'user_id' =>
                    $administrador->id,

                'requerimiento_id' =>
                    $requerimiento->id,

                'titulo' =>
                    'Gestión técnica actualizada',

                'mensaje' =>
                    $mensajeAdministrador,

                'leida' =>
                    false,
            ]);
        }

        return redirect()
            ->route(
                'requerimientos.show',
                $requerimiento
            )
            ->with(
                'success',
                'Gestión técnica registrada correctamente.'
            );
    }
}