<?php

namespace App\Http\Controllers;

use App\Models\Requerimiento;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Muestra el panel principal del administrador
     * con indicadores y estadísticas del sistema.
     */
    public function index()
    {
        /*
         * Solo los usuarios con rol administrador
         * pueden acceder al dashboard.
         */
        if (Auth::user()->rol !== 'administrador') {
            abort(
                403,
                'No tiene permiso para acceder a esta sección.'
            );
        }

        /*
         * Indicadores generales.
         */
        $totalUsuarios = User::count();

        $totalRequerimientos = Requerimiento::count();

        $totalPendientes = Requerimiento::where(
            'estado',
            'pendiente'
        )->count();

        $totalEnProceso = Requerimiento::where(
            'estado',
            'en_proceso'
        )->count();

        $totalResueltos = Requerimiento::where(
            'estado',
            'resuelto'
        )->count();

        $totalUrgentes = Requerimiento::where(
            'prioridad',
            'urgente'
        )->count();

        /*
         * Cantidad de requerimientos agrupados
         * por categoría.
         *
         * Esta información será utilizada
         * posteriormente para generar el gráfico.
         */
        $requerimientosPorCategoria = Requerimiento::select(
            'categoria',
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('categoria')
            ->orderBy('categoria')
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'totalUsuarios',
                'totalRequerimientos',
                'totalPendientes',
                'totalEnProceso',
                'totalResueltos',
                'totalUrgentes',
                'requerimientosPorCategoria'
            )
        );
    }
}
