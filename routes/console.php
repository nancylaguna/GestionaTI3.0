<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|------------------------------------------------- -------------------------
| Rutas de consola
|------------------------------------------------- -------------------------
|
| Este archivo es donde puede definir toda su consola basada en Cierre.
| comandos. Cada cierre está vinculado a una instancia de comando que permite un
| Enfoque simple para interactuar con los métodos IO de cada comando.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
