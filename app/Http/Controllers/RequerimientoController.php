<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Requerimiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequerimientoController extends Controller
{
    /**
     * Verifica que el usuario autenticado tenga rol administrador.
     */
    private function verificarAdministrador(): void
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(
                403,
                'No tiene permiso para acceder a esta sección.'
            );
        }
    }

    /**
     * Muestra los requerimientos pertenecientes
     * al funcionario autenticado.
     */
    public function index()
    {
        $requerimientos = Requerimiento::where(
            'user_id',
            Auth::id()
        )
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'requerimientos.index',
            compact('requerimientos')
        );
    }

    /**
     * Muestra el formulario para registrar un requerimiento.
     */
    public function create()
    {
        return view('requerimientos.create');
    }

    /**
     * Guarda un requerimiento nuevo y notifica
     * a los administradores del sistema.
     *
     * La prioridad queda pendiente de clasificación
     * por parte del administrador.
     */
    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'categoria' => [
                    'required',
                    'string',
                    'in:computador,correo,internet,impresora,sistema,firma,usuario,otro',
                ],

                'titulo' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'descripcion' => [
                    'required',
                    'string',
                ],
            ],
            [
                'categoria.required' =>
                    'Debe seleccionar una categoría.',

                'categoria.in' =>
                    'La categoría seleccionada no es válida.',

                'titulo.required' =>
                    'Debe ingresar un título.',

                'titulo.max' =>
                    'El título no puede superar los 255 caracteres.',

                'descripcion.required' =>
                    'Debe ingresar una descripción.',
            ]
        );

        /*
         * Se crea el requerimiento asociado
         * al usuario autenticado.
         */
        $requerimiento = Requerimiento::create([
            'user_id' => Auth::id(),
            'categoria' => $datos['categoria'],
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'prioridad' => 'sin_asignar',
            'estado' => 'pendiente',
        ]);

        /*
         * Se buscan los administradores.
         */
        $administradores = User::where(
            'rol',
            'administrador'
        )
            ->where('id', '!=', Auth::id())
            ->get();

        /*
         * Se notifica a los administradores.
         */
        foreach ($administradores as $administrador) {
            Notificacion::create([
                'user_id' => $administrador->id,

                'requerimiento_id' =>
                    $requerimiento->id,

                'titulo' =>
                    'Nuevo requerimiento recibido',

                'mensaje' =>
                    Auth::user()->name .
                    ' registró el requerimiento N.º ' .
                    $requerimiento->id .
                    ' "' .
                    $requerimiento->titulo .
                    '". Pendiente de clasificación de prioridad.',

                'leida' => false,
            ]);
        }

        return redirect()
            ->route('requerimientos.index')
            ->with(
                'success',
                'Requerimiento creado correctamente.'
            );
    }

    /**
     * Muestra el detalle de un requerimiento.
     */
    public function show(Requerimiento $requerimiento)
    {
        $esPropietario =
            $requerimiento->user_id === Auth::id();

        $esAdministrador =
            Auth::user()->rol === 'administrador';

        if (!$esPropietario && !$esAdministrador) {
            abort(
                403,
                'No tiene permiso para ver este requerimiento.'
            );
        }

        return view(
            'requerimientos.show',
            compact('requerimiento')
        );
    }

    /**
     * Muestra todos los requerimientos al administrador.
     */
    public function adminIndex()
    {
        $this->verificarAdministrador();

        $requerimientos = Requerimiento::with('usuario')
            ->orderBy('created_at', 'desc')
            ->get();

        return view(
            'admin.requerimientos.index',
            compact('requerimientos')
        );
    }

    /**
     * Muestra el formulario administrativo
     * para gestionar un requerimiento.
     */
    public function edit(Requerimiento $requerimiento)
    {
        $this->verificarAdministrador();

        return view(
            'admin.requerimientos.edit',
            compact('requerimiento')
        );
    }

    /**
     * Actualiza prioridad, estado y respuesta administrativa.
     *
     * Si cambia la prioridad o el estado,
     * se notifica al funcionario propietario.
     */
    public function update(
        Request $request,
        Requerimiento $requerimiento
    ) {
        $this->verificarAdministrador();

        $datos = $request->validate(
            [
                'prioridad' => [
                    'required',
                    'string',
                    'in:sin_asignar,baja,media,alta,urgente',
                ],

                'estado' => [
                    'required',
                    'string',
                    'in:pendiente,en_revision,en_proceso,resuelto,cerrado,rechazado',
                ],

                'respuesta_admin' => [
                    'nullable',
                    'string',
                ],
            ],
            [
                'prioridad.required' =>
                    'Debe seleccionar una prioridad.',

                'prioridad.in' =>
                    'La prioridad seleccionada no es válida.',

                'estado.required' =>
                    'Debe seleccionar un estado.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        /*
         * Se guardan los valores anteriores
         * para detectar si hubo cambios.
         */
        $estadoAnterior = $requerimiento->estado;
        $prioridadAnterior = $requerimiento->prioridad;

        /*
         * Si el requerimiento queda resuelto o cerrado,
         * se registra la fecha de cierre.
         */
        if (
            in_array(
                $datos['estado'],
                ['resuelto', 'cerrado'],
                true
            )
        ) {
            $fechaCierre =
                $requerimiento->fecha_cierre ?? now();
        } else {
            $fechaCierre = null;
        }

        /*
         * Se actualiza el requerimiento.
         */
        $requerimiento->update([
            'prioridad' => $datos['prioridad'],

            'estado' => $datos['estado'],

            'respuesta_admin' =>
                $datos['respuesta_admin'] ?? null,

            'fecha_cierre' => $fechaCierre,
        ]);

        /*
         * Se construye el mensaje de notificación
         * según los cambios realizados.
         */
        $cambios = [];

        if ($prioridadAnterior !== $datos['prioridad']) {
            $nombrePrioridad = ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $datos['prioridad']
                )
            );

            $cambios[] =
                'prioridad: ' . $nombrePrioridad;
        }

        if ($estadoAnterior !== $datos['estado']) {
            $nombreEstado = ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $datos['estado']
                )
            );

            $cambios[] =
                'estado: ' . $nombreEstado;
        }

        /*
         * Se notifica al funcionario cuando
         * cambia prioridad o estado.
         */
        if (
            $requerimiento->user_id &&
            count($cambios) > 0
        ) {
            Notificacion::create([
                'user_id' =>
                    $requerimiento->user_id,

                'requerimiento_id' =>
                    $requerimiento->id,

                'titulo' =>
                    'Actualización de requerimiento',

                'mensaje' =>
                    'Su requerimiento "' .
                    $requerimiento->titulo .
                    '" fue actualizado. ' .
                    ucfirst(
                        implode(
                            ' | ',
                            $cambios
                        )
                    ) .
                    '.',

                'leida' => false,
            ]);
        }

        return redirect()
            ->route('admin.requerimientos.index')
            ->with(
                'success',
                'Requerimiento actualizado correctamente.'
            );
    }

    /**
     * Elimina un requerimiento.
     */
    public function destroy(
        Requerimiento $requerimiento
    ) {
        $this->verificarAdministrador();

        $requerimiento->delete();

        return redirect()
            ->route('admin.requerimientos.index')
            ->with(
                'success',
                'Requerimiento eliminado correctamente.'
            );
    }
}