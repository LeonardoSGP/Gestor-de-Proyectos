<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CriterioEvaluacion;
use App\Models\Evento;
use Illuminate\Http\Request;

class CriterioController extends Controller
{
    public function store(Request $request, Evento $evento)
    {

        //Validacion de datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ponderacion' => 'required|integer|min:1|max:100',
        ]);

        //validacion del negocio
        $suma_actual = $evento->criterios()->sum('ponderacion');

        if (($suma_actual + $request->ponderacion) > 100) {
            return back()->withErrors(['ponderacion' => 'La suma de ponderaciones superaría el 100%. Actualmente llevas ' . $suma_actual . '%.']);
        }

        //Crear el criterio
        $evento->criterios()->create([
            'nombre' => $request->nombre,
            'ponderacion' => $request->ponderacion
        ]);

        return back()->with('success', 'Criterio agregado correctamente.');
    }
    
    public function edit(CriterioEvaluacion $criterio)
    {
        return view('admin.criterios.edit', compact('criterio'));
    }

    public function update(Request $request, CriterioEvaluacion $criterio)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ponderacion' => 'required|integer|min:1|max:100',
        ]);

        $evento = $criterio->evento;

        // Cálculo matemático: Suma total de los OTROS criterios (excluyendo el actual)
        $suma_otros = $evento->criterios()->where('id', '!=', $criterio->id)->sum('ponderacion');
        
        // Verificamos si el nuevo valor rompe el límite
        if (($suma_otros + $request->ponderacion) > 100) {
            return back()->withErrors(['ponderacion' => 'Error: La suma total sería ' . ($suma_otros + $request->ponderacion) . '%. Ajusta los otros criterios primero.']);
        }

        $criterio->update($request->only('nombre', 'ponderacion'));

        // Redirigimos al detalle del EVENTO, no al criterio
        return redirect()->route('admin.eventos.show', $evento)->with('success', 'Criterio actualizado.');
    }

    public function destroy(CriterioEvaluacion $criterio)
    {
        $criterio->delete();
        return back()->with('success', 'Criterio eliminado.');
    }
}
