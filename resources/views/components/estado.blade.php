@props(['estado'])

@php
    $textos = [
        'pendiente' => 'Pendiente',
        'en_revision' => 'En revisión',
        'en_proceso' => 'En proceso',
        'resuelto' => 'Resuelto',
        'cerrado' => 'Cerrado',
        'rechazado' => 'Rechazado',
    ];

    $clases = [
        'pendiente' => 'estado-badge estado-pendiente',
        'en_revision' => 'estado-badge estado-revision',
        'en_proceso' => 'estado-badge estado-proceso',
        'resuelto' => 'estado-badge estado-resuelto',
        'cerrado' => 'estado-badge estado-cerrado',
        'rechazado' => 'estado-badge estado-rechazado',
    ];

    $texto = $textos[$estado] ?? ucfirst(str_replace('_', ' ', $estado));
    $clase = $clases[$estado] ?? 'estado-badge';
@endphp

<span class="{{ $clase }}">
    {{ $texto }}
</span>