<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Equipo;
use App\Models\Evento;
use App\Models\Proyecto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Muestra la vista principal de reportes
     */
    public function index()
    {
        // Estadísticas para mostrar en la vista
        $totalUsuarios = User::count();
        $totalEquipos = Equipo::count();
        $totalEventos = Evento::count();
        $totalProyectos = Proyecto::count();

        return view('admin.reportes.index', compact(
            'totalUsuarios',
            'totalEquipos',
            'totalEventos',
            'totalProyectos'
        ));
    }

    /**
     * Genera PDF de reporte de usuarios
     */
    public function usuariosPdf()
    {
        $usuarios = User::with(['roles', 'participante.carrera'])->latest()->get();

        $pdf = Pdf::loadView('admin.reportes.usuarios_pdf', compact('usuarios'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Reporte_Usuarios_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Genera PDF de reporte de equipos
     */
    public function equiposPdf()
    {
        $equipos = Equipo::with(['participantes.user', 'proyecto.evento'])->latest()->get();

        $pdf = Pdf::loadView('admin.reportes.equipos_pdf', compact('equipos'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Reporte_Equipos_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Genera PDF de reporte de eventos
     */
    public function eventosPdf()
    {
        $eventos = Evento::with(['proyectos', 'criterios'])->latest()->get();

        $pdf = Pdf::loadView('admin.reportes.eventos_pdf', compact('eventos'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Reporte_Eventos_' . date('Y-m-d') . '.pdf');
    }

    /**
     * Genera PDF de reporte de proyectos
     */
    public function proyectosPdf()
    {
        $proyectos = Proyecto::with(['equipo.participantes.user', 'evento', 'calificaciones'])->latest()->get();

        $pdf = Pdf::loadView('admin.reportes.proyectos_pdf', compact('proyectos'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream('Reporte_Proyectos_' . date('Y-m-d') . '.pdf');
    }
}
