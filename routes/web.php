<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidatoController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\GraficaController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Candidatos Index
//Route::get('/candidatos', [AppController::class,'index1'])->name('candidatos.index');

Route::get('/candidatos', [CandidatoController::class, 'index1'])->name('candidatos.index');

// Graficas Index
Route::get('/graficas', [GraficaController::class, 'index2'])->name('graficas.index');
Route::post('/get-chart-data', [GraficaController::class, 'getChartData']);

// Vacantes index
Route::get('/vacantes', [VacanteController::class, 'index3'])->name('vacantes.index');


require __DIR__.'/auth.php';
