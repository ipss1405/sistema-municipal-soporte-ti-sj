<?php

namespace App\Http\Controllers;

use App\Models\Requerimiento;
use Illuminate\Http\Request;

class RequerimientoController extends Controller
{
    public function index()
    {
        $requerimientos = Requerimiento::orderBy('created_at', 'desc')->get();

        return view('requerimientos.index', compact('requerimientos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'categoria' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'prioridad' => 'required|in:baja,media,alta,urgente',
        ]);

        $datos['user_id'] = null;
        $datos['estado'] = 'pendiente';

        Requerimiento::create($datos);

        return redirect('/mis-requerimientos')
            ->with('success', 'Requerimiento registrado correctamente.');
    }

    public function show(Requerimiento $requerimiento)
    {
        return view('requerimientos.show', compact('requerimiento'));
    }
}