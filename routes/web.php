<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\GraficaController;

/*
|--------------------------------------------------------------------------
| Rutas Web
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. Estas
| rutas se cargan en RouteServiceProvider y todas ellas se asignarán al
| grupo de middleware "web". ¡Haz algo genial!
|
*/

// Ruta de inicio de sesión
Route::get('/', function () {
    return view('auth.login');
});

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas de Candidatos
Route::get('/candidatos', [CandidatoController::class, 'index1'])->name('candidatos.index');

// Rutas de Gráficas
Route::get('/graficas', [GraficaController::class, 'index2'])->name('graficas.index');

// Rutas de Vacantes
Route::get('/vacantes', [VacanteController::class, 'index3'])->name('vacantes.index');

// Rutas de Autenticación (auth.php)
require __DIR__.'/auth.php';
