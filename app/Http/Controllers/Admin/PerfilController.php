<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PerfilController extends Controller
{
    /**
     * Muestra la lista de perfiles.
     */
    public function index(Request $request)
    {
        $query = Perfil::query();

        // Buscador
        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        $perfiles = $query->latest()->paginate(10)->withQueryString();

        return view('admin.perfiles.index', compact('perfiles'));
    }

    /**
     * Muestra el formulario para crear un nuevo perfil.
     */
    public function create()
    {
        return view('admin.perfiles.create');
    }

    /**
     * Almacena un nuevo perfil en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'max:255', 'unique:perfiles,nombre'],
        ]);

        Perfil::create($request->only('nombre'));

        return redirect()->route('admin.perfiles.index')
            ->with('success', 'Perfil creado exitosamente.');
    }

    /**
     * Muestra el formulario para editar un perfil existente.
     */
    public function edit(Perfil $perfile) // Nota: Laravel a veces singulariza 'perfiles' como 'perfile' en el route model binding si no se configura diferente
    {
        return view('admin.perfiles.edit', ['perfil' => $perfile]);
    }

    /**
     * Actualiza el perfil especificado en la base de datos.
     */
    public function update(Request $request, Perfil $perfile)
    {
        $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('perfiles', 'nombre')->ignore($perfile->id),
            ],
        ]);

        $perfile->update($request->only('nombre'));

        return redirect()->route('admin.perfiles.index')
            ->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina el perfil especificado de la base de datos.
     */
    public function destroy(Perfil $perfile)
    {
        // Opcional: Validar si el perfil está siendo usado antes de eliminar (aunque soft deletes lo maneja bien)
        $perfile->delete();

        return redirect()->route('admin.perfiles.index')
            ->with('success', 'Perfil eliminado correctamente.');
    }
}