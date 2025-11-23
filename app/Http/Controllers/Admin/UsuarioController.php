<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUsuarioRequest;
use App\Http\Requests\Admin\UpdateUsuarioRequest;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Iniciamos la consulta
        $query = User::with('roles')->latest();

        // 1. Filtro por Texto (Nombre o Email)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 2. Filtro por Rol
        if ($request->filled('role')) {
            $roleName = $request->role;
            $query->whereHas('roles', function ($q) use ($roleName) {
                $q->where('nombre', $roleName);
            });
        }

        // Paginamos y mantenemos los filtros en la URL (para que al cambiar de página no se pierda la búsqueda)
        $usuarios = $query->paginate(10)->withQueryString();

        // Necesitamos enviar los roles a la vista para llenar el <select> del filtro
        $roles = Rol::all();

        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Enviamos los roles a la vista para el <select>
        $roles = Rol::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        // 1. Crear el usuario (encriptando la contraseña)
        $user = User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Asignar el Rol en la tabla pivote (user_rol)
        // attach() crea la relación en la tabla intermedia
        $user->roles()->attach($request->rol_id);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado y rol asignado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        // Reutilizamos la vista de edit o podrías hacer una show aparte
        // Por ahora redirigimos a edit para agilizar
        return redirect()->route('admin.usuarios.edit', $usuario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        $roles = Rol::all();
        // Cargamos los roles actuales del usuario para marcarlos en el select
        $usuario->load('roles');

        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, User $usuario)
    {
        // 1. Preparar datos básicos
        $data = [
            'name' => $request->nombre,
            'email' => $request->email,
        ];

        // 2. Si escribió contraseña nueva, la encriptamos. Si no, la ignoramos.
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // 3. Actualizar tabla users
        $usuario->update($data);

        // 4. Sincronizar Rol (Borra los anteriores y pone el nuevo)
        $usuario->roles()->sync([$request->rol_id]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        // Evitar que el admin se borre a sí mismo por error
        if (Auth::id() === $usuario->id) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $usuario->delete();
        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado del sistema.');
    }
}
