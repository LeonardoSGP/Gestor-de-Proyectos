<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEquipoRequest;
use App\Http\Requests\Admin\UpdateEquipoRequest;
use App\Models\Equipo;
use App\Models\Evento;
use App\Models\Participante;
use App\Models\Perfil;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index(Request $request)
    {
        // (Tu código del index anterior aquí...)
        // Solo asegúrate de retornar la vista correcta
        $query = Equipo::with(['proyecto.evento', 'participantes']);
        if ($request->filled('search')) $query->where('nombre', 'like', '%' . $request->search . '%');
        
        $equipos = $query->latest()->paginate(10)->withQueryString();
        $eventos = Evento::all();

        return view('admin.equipos.index', compact('equipos', 'eventos'));
    }

    // 👇 NUEVO: Vista de Creación
    public function create()
    {
        return view('admin.equipos.create');
    }

    // 👇 NUEVO: Guardar Equipo
    public function store(StoreEquipoRequest $request)
    {
        $equipo = Equipo::create($request->validated());
        
        // Redirigimos directo al show para que el admin agregue miembros
        return redirect()->route('admin.equipos.show', $equipo)
                         ->with('success', 'Equipo creado. Ahora agrega los integrantes.');
    }

    // 👇 ACTUALIZADO: Show con lista inteligente
    public function show(Equipo $equipo)
    {
        $equipo->load(['participantes.user', 'participantes.carrera', 'proyecto.evento']);
        
        $perfiles = Perfil::all();

        // Traemos TODOS los participantes con sus equipos para ver el estado
        // En un sistema real con miles de alumnos, esto debería ser una API con búsqueda AJAX (Select2)
        // Para este proyecto, traerlos todos y filtrar con JS (Alpine) está bien.
        $todos_participantes = Participante::with(['user', 'equipos'])->get();

        return view('admin.equipos.show', compact('equipo', 'perfiles', 'todos_participantes'));
    }

    // ... (edit, update, destroy se mantienen igual) ...
    public function edit(Equipo $equipo)
    {
        return view('admin.equipos.edit', compact('equipo'));
    }

    public function update(UpdateEquipoRequest $request, Equipo $equipo)
    {
        $equipo->update($request->validated());
        return redirect()->route('admin.equipos.show', $equipo)->with('success', 'Equipo actualizado.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('admin.equipos.index')->with('success', 'Equipo eliminado.');
    }

    // ---------------------------------------------------
    // LÓGICA DE MIEMBROS
    // ---------------------------------------------------

    public function addMember(Request $request, Equipo $equipo)
    {
        $request->validate([
            'participante_id' => 'required|exists:participantes,id', // Cambiamos a ID directo desde el select
            'perfil_id' => 'required|exists:perfiles,id',
        ]);

        // Validar si ya está en el equipo
        if ($equipo->participantes->contains($request->participante_id)) {
            return back()->with('error', 'Este participante ya está en el equipo.');
        }

        $equipo->participantes()->attach($request->participante_id, [
            'perfil_id' => $request->perfil_id
        ]);

        return back()->with('success', 'Participante agregado.');
    }

    public function removeMember(Equipo $equipo, Participante $participante)
    {
        $equipo->participantes()->detach($participante->id);
        return back()->with('success', 'Miembro eliminado.');
    }
}
