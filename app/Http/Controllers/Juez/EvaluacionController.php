<?php

namespace App\Http\Controllers\Juez;

use App\Http\Controllers\Controller;
use App\Models\Calificacion;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionController extends Controller
{

    public function edit(Proyecto $proyecto)
    {
        // Cargar criterios del evento y ver si ya hay calificaciones previas de este juez
        $proyecto->load(['evento.criterios', 'equipo']);
        
        // Obtener calificaciones previas del juez actual para llenar el formulario (si está editando)
        $calificacionesPrevias = Calificacion::where('proyecto_id', $proyecto->id)
                                             ->where('juez_user_id', Auth::id())
                                             ->get()
                                             ->keyBy('criterio_id');

        return view('juez.evaluar', compact('proyecto', 'calificacionesPrevias'));
    }
    
    public function store(Request $request, Proyecto $proyecto)
    {
        $data = $request->validate([
            'puntuaciones' => 'required|array',
            'puntuaciones.*' => 'required|integer|min:0|max:100', // Validar cada input del array
        ]);

        $juezId = Auth::id();

        // Iteramos sobre el array de puntuaciones [criterio_id => puntos]
        foreach ($data['puntuaciones'] as $criterioId => $puntos) {
            
            // Usamos updateOrCreate para guardar o actualizar si ya existía
            Calificacion::updateOrCreate(
                [
                    'proyecto_id' => $proyecto->id,
                    'juez_user_id' => $juezId,
                    'criterio_id' => $criterioId,
                ],
                [
                    'puntuacion' => $puntos
                ]
            );
        }

        return redirect()->route('juez.dashboard')->with('success', 'Evaluación guardada correctamente.');
    }
}
