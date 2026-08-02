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

                'prioridad' => [
                    'required',
                    'string',
                    'in:baja,media,alta,urgente',
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

                'prioridad.required' =>
                    'Debe seleccionar una prioridad.',

                'prioridad.in' =>
                    'La prioridad seleccionada no es válida.',
            ]
        );

        /*
         * Se crea el requerimiento asociado
         * al usuario que inició sesión.
         */
        $requerimiento = Requerimiento::create([
            'user_id' => Auth::id(),
            'categoria' => $datos['categoria'],
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'prioridad' => $datos['prioridad'],
            'estado' => 'pendiente',
        ]);

        /*
         * Se buscan todos los administradores.
         *
         * Se excluye al usuario actual para evitar
         * que un administrador se notifique a sí mismo
         * cuando registra un requerimiento.
         */
        $administradores = User::where(
            'rol',
            'administrador'
        )
            ->where('id', '!=', Auth::id())
            ->get();

        /*
         * Se crea una notificación para cada
         * administrador encontrado.
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
                    ' registró el requerimiento "' .
                    $requerimiento->titulo .
                    '" con prioridad ' .
                    ucfirst($requerimiento->prioridad) .
                    '.',

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
     *
     * Se utiliza Eager Loading para cargar
     * anticipadamente la relación con el usuario
     * y evitar el problema N+1.
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
     * Actualiza el estado y la respuesta administrativa.
     *
     * Cuando cambia el estado, se notifica
     * al funcionario propietario.
     */
    public function update(
        Request $request,
        Requerimiento $requerimiento
    ) {
        $this->verificarAdministrador();

        $datos = $request->validate(
            [
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
                'estado.required' =>
                    'Debe seleccionar un estado.',

                'estado.in' =>
                    'El estado seleccionado no es válido.',
            ]
        );

        $estadoAnterior = $requerimiento->estado;

        /*
         * Si el requerimiento queda resuelto o cerrado,
         * se registra la fecha de cierre.
         *
         * Si vuelve a otro estado, la fecha se elimina.
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

        $requerimiento->update([
            'estado' => $datos['estado'],

            'respuesta_admin' =>
                $datos['respuesta_admin'] ?? null,

            'fecha_cierre' => $fechaCierre,
        ]);

        /*
         * Se crea una notificación solo cuando
         * el estado realmente cambió.
         */
        if (
            $requerimiento->user_id &&
            $estadoAnterior !== $datos['estado']
        ) {
            $nombreEstado = ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $datos['estado']
                )
            );

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
                    '" cambió de estado a: ' .
                    $nombreEstado .
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