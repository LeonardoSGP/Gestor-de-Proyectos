<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Juez\JuezController;
use App\Http\Controllers\Participante\ParticipanteController;

Route::get('/', function () {
    return view('welcome');
});

//Rutas comunes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//--RUTAS ADMINISTRADOR--
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    //ruta de EVENTOS
    Route::resource('eventos', 'App\Http\Controllers\Admin\EventoController');

    //rutas de CRITERIOS
    Route::post('/eventos/{evento}/criterios', [\App\Http\Controllers\Admin\CriterioController::class, 'store'])->name('eventos.criterios.store');
    Route::get('/criterios/{criterio}/edit', [\App\Http\Controllers\Admin\CriterioController::class, 'edit'])->name('criterios.edit');
    Route::put('/criterios/{criterio}', [\App\Http\Controllers\Admin\CriterioController::class, 'update'])->name('criterios.update');
    Route::delete('/criterios/{criterio}', [\App\Http\Controllers\Admin\CriterioController::class, 'destroy'])->name('criterios.destroy');

    //ruta de USUARIOS
    Route::resource('usuarios', \App\Http\Controllers\Admin\UsuarioController::class);

    //ruta de EQUIPOS
    Route::resource('equipos', \App\Http\Controllers\Admin\EquipoController::class);
    Route::post('/equipos/{equipo}/miembros', [\App\Http\Controllers\Admin\EquipoController::class, 'addMember'])->name('equipos.miembros.store');
    Route::delete('/equipos/{equipo}/miembros/{participante}', [\App\Http\Controllers\Admin\EquipoController::class, 'removeMember'])->name('equipos.miembros.destroy');

    //ruta de PROYECTOS
    Route::resource('proyectos', \App\Http\Controllers\Admin\ProyectoController::class);

    //ruta de RESULTADOS
    Route::get('/resultados', [\App\Http\Controllers\Admin\ResultadosController::class, 'index'])->name('resultados.index');
    Route::get('/resultados/constancia/{proyecto}/{posicion}', [\App\Http\Controllers\Admin\ResultadosController::class, 'descargarConstancia'])->name('constancia.descargar');

});

//--RTUAS JUEZ--
Route::middleware(['auth', 'role:Juez'])->prefix('juez')->name('juez.')->group(function () {
    Route::get('/dashboard', [JuezController::class, 'index'])->name('dashboard');


    //ruta de CALIFICACIONES
    Route::get('/evaluar/{proyecto}', [\App\Http\Controllers\Juez\EvaluacionController::class, 'edit'])->name('evaluacion.edit');
    Route::post('/evaluar/{proyecto}', [\App\Http\Controllers\Juez\EvaluacionController::class, 'store'])->name('evaluacion.store');
});


//--RUTAS PARTICIPANTE--
Route::middleware(['auth', 'role:Participante'])->prefix('participante')->name('participante.')->group(function () {

    Route::get('/registro-inicial', [ParticipanteController::class, 'index'])->name('registro.inicial');

    Route::get('/dashboard', [ParticipanteController::class, 'index'])->name('dashboard');
});



require __DIR__ . '/auth.php';
