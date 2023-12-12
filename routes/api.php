<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|------------------------------------------------- -------------------------
| Rutas API
|------------------------------------------------- -------------------------
|
| Aquí es donde puede registrar rutas API para su aplicación. Estos
| las rutas son cargadas por RouteServiceProvider dentro de un grupo que
| se le asigna el grupo de middleware "api". 
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
