<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificacionController extends Controller
{
    /**
     * Muestra las notificaciones pertenecientes
     * al usuario autenticado.
     */
    public function index(): View
    {
        /*
         * Solo se consultan las notificaciones
         * del usuario que tiene la sesión activa.
         */
        $notificaciones = Notificacion::where(
            'user_id',
            Auth::id()
        )
            ->orderBy('created_at', 'desc')
            ->get();

        /*
         * Después de cargarlas, todas las notificaciones
         * pendientes del usuario se marcan como leídas.
         *
         * De esta forma, las nuevas se muestran una vez
         * con su etiqueta y luego el contador vuelve a cero.
         */
        Notificacion::where(
            'user_id',
            Auth::id()
        )
            ->where('leida', false)
            ->update([
                'leida' => true,
                'fecha_leida' => now(),
            ]);

        return view(
            'notificaciones.index',
            compact('notificaciones')
        );
    }

    /**
     * Devuelve la cantidad de notificaciones
     * no leídas del usuario autenticado.
     */
    public function contador(): JsonResponse
    {
        $total = Notificacion::where(
            'user_id',
            Auth::id()
        )
            ->where('leida', false)
            ->count();

        return response()->json([
            'total' => $total,
        ]);
    }
}