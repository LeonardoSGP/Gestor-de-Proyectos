<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCarreraRequest;
use App\Http\Requests\Admin\UpdateCarreraRequest;
use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index(Request $request)
    {
        $query = Carrera::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nombre', 'like', '%' . $request->search . '%')
                ->orWhere('clave', 'like', '%' . $request->search . '%');
        }

        $carreras = $query->latest()->paginate(10)->withQueryString();

        return view('admin.carreras.index', compact('carreras'));
    }

    public function create()
    {
        return view('admin.carreras.create');
    }

    public function store(StoreCarreraRequest $request) 
    {
        Carrera::create($request->validated());
        return redirect()->route('admin.carreras.index')->with('success', 'Carrera creada exitosamente.');
    }

    public function edit(Carrera $carrera)
    {
        return view('admin.carreras.edit', compact('carrera'));
    }

    public function update(UpdateCarreraRequest $request, Carrera $carrera)
    {
        $carrera->update($request->validated());
        return redirect()->route('admin.carreras.index')->with('success', 'Carrera actualizada exitosamente.');
    }

    public function destroy(Carrera $carrera)
    {
        if($carrera->participantes()->exists()){
            return back()->with('error', 'No se puede eliminar la carrera porque tiene alumnos inscritos.');
        }

        $carrera->delete();
        return redirect()->route('admin.carreras.index')->with('success', 'Carrera eliminada exitosamente.');
    }
}
