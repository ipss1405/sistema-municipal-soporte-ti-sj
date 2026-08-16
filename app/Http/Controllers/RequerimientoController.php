<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\Requerimiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
     * Muestra los requerimientos al administrador
     * y permite filtrarlos por estado, prioridad,
     * categoría y funcionario.
     */
    public function adminIndex(Request $request)
    {
        $this->verificarAdministrador();

        /*
         * Se validan los filtros recibidos desde
         * la URL mediante parámetros GET.
         */
        $filtros = $request->validate([
            'estado' => [
                'nullable',
                'string',
                'in:pendiente,en_revision,en_proceso,resuelto,cerrado,rechazado',
            ],

            'prioridad' => [
                'nullable',
                'string',
                'in:sin_asignar,baja,media,alta,urgente',
            ],

            'categoria' => [
                'nullable',
                'string',
                'in:computador,correo,internet,impresora,sistema,firma,usuario,otro',
            ],

            'funcionario' => [
                'nullable',
                'integer',
                'exists:users,id',
            ],
        ]);

        /*
         * Se inicia la consulta cargando también
         * las relaciones con funcionario y técnico.
         */
        $consulta = Requerimiento::with([
            'usuario',
            'tecnico',
        ]);

        /*
         * Filtro por estado.
         */
        if (!empty($filtros['estado'])) {
            $consulta->where(
                'estado',
                $filtros['estado']
            );
        }

        /*
         * Filtro por prioridad.
         */
        if (!empty($filtros['prioridad'])) {
            $consulta->where(
                'prioridad',
                $filtros['prioridad']
            );
        }

        /*
         * Filtro por categoría.
         */
        if (!empty($filtros['categoria'])) {
            $consulta->where(
                'categoria',
                $filtros['categoria']
            );
        }

        /*
         * Filtro por funcionario.
         */
        if (!empty($filtros['funcionario'])) {
            $consulta->where(
                'user_id',
                $filtros['funcionario']
            );
        }

        /*
         * Los resultados se ordenan desde
         * el requerimiento más reciente.
         */
        $requerimientos = $consulta
            ->orderBy('created_at', 'desc')
            ->get();

        /*
         * Lista de funcionarios utilizada
         * en el selector del filtro.
         */
        $funcionarios = User::where(
            'rol',
            'funcionario'
        )
            ->orderBy('name')
            ->get();

        return view(
            'admin.requerimientos.index',
            compact(
                'requerimientos',
                'funcionarios'
            )
        );
    }

    /**
     * Muestra el formulario administrativo
     * para gestionar y derivar un requerimiento.
     */
    public function edit(Requerimiento $requerimiento)
    {
        $this->verificarAdministrador();

        /*
         * Se obtienen solamente los usuarios
         * que poseen rol técnico.
         */
        $tecnicos = User::where(
            'rol',
            'tecnico'
        )
            ->orderBy('name')
            ->get();

        /*
         * Se cargan los datos de derivación
         * actualmente asociados al requerimiento.
         */
        $requerimiento->load([
            'tecnico',
            'asignadoPor',
        ]);

        return view(
            'admin.requerimientos.edit',
            compact(
                'requerimiento',
                'tecnicos'
            )
        );
    }

    /**
     * Actualiza prioridad, estado, derivación TI
     * y respuesta administrativa.
     *
     * La fecha de asignación y el administrador
     * responsable se registran automáticamente.
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

                'tecnico_id' => [
                    'nullable',
                    'integer',
                    Rule::exists('users', 'id')
                        ->where(
                            fn ($query) =>
                                $query->where(
                                    'rol',
                                    'tecnico'
                                )
                        ),
                ],

                'tarea_asignada' => [
                    'nullable',
                    'required_with:tecnico_id',
                    'string',
                    'max:2000',
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

                'tecnico_id.exists' =>
                    'El técnico seleccionado no es válido.',

                'tarea_asignada.required_with' =>
                    'Debe indicar la tarea que realizará el técnico.',

                'tarea_asignada.max' =>
                    'La tarea asignada no puede superar los 2000 caracteres.',
            ]
        );

        /*
         * Se guardan los valores anteriores
         * para detectar cambios.
         */
        $estadoAnterior =
            $requerimiento->estado;

        $prioridadAnterior =
            $requerimiento->prioridad;

        $tecnicoAnterior =
            $requerimiento->tecnico_id;

        /*
         * Se determina el técnico seleccionado.
         */
        $tecnicoNuevo = !empty($datos['tecnico_id'])
            ? (int) $datos['tecnico_id']
            : null;

        $cambioTecnico =
            $tecnicoAnterior !== $tecnicoNuevo;

        /*
         * Gestión automática de la derivación.
         *
         * Si se selecciona un técnico por primera vez
         * o se cambia de técnico, se registra una nueva
         * fecha y hora de asignación.
         */
        if ($tecnicoNuevo) {

            if (
                $cambioTecnico ||
                !$requerimiento->fecha_asignacion
            ) {
                $fechaAsignacion = now();
                $asignadoPorId = Auth::id();
            } else {
                $fechaAsignacion =
                    $requerimiento->fecha_asignacion;

                $asignadoPorId =
                    $requerimiento->asignado_por_id;
            }

            $tareaAsignada =
                $datos['tarea_asignada'];

        } else {

            /*
             * Si se retira la derivación,
             * los datos asociados quedan vacíos.
             */
            $fechaAsignacion = null;
            $asignadoPorId = null;
            $tareaAsignada = null;
        }

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
            'prioridad' =>
                $datos['prioridad'],

            'estado' =>
                $datos['estado'],

            'tecnico_id' =>
                $tecnicoNuevo,

            'asignado_por_id' =>
                $asignadoPorId,

            'fecha_asignacion' =>
                $fechaAsignacion,

            'tarea_asignada' =>
                $tareaAsignada,

            'respuesta_admin' =>
                $datos['respuesta_admin'] ?? null,

            'fecha_cierre' =>
                $fechaCierre,
        ]);

        /*
         * Se construye el mensaje de notificación
         * para el funcionario según los cambios.
         */
        $cambios = [];

        if (
            $prioridadAnterior !==
            $datos['prioridad']
        ) {
            $nombrePrioridad = ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $datos['prioridad']
                )
            );

            $cambios[] =
                'prioridad: ' .
                $nombrePrioridad;
        }

        if (
            $estadoAnterior !==
            $datos['estado']
        ) {
            $nombreEstado = ucfirst(
                str_replace(
                    '_',
                    ' ',
                    $datos['estado']
                )
            );

            $cambios[] =
                'estado: ' .
                $nombreEstado;
        }

        /*
         * Si cambió el técnico responsable,
         * también se informa al funcionario.
         */
        if ($cambioTecnico) {

            if ($tecnicoNuevo) {

                $tecnico =
                    User::find($tecnicoNuevo);

                $cambios[] =
                    'derivado a TI: ' .
                    $tecnico->name;

            } else {

                $cambios[] =
                    'derivación TI retirada';
            }
        }

        /*
         * Se notifica al funcionario cuando
         * existe algún cambio relevante.
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
                    'Su requerimiento N.º ' .
                    $requerimiento->id .
                    ' "' .
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