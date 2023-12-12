<?php

use Illuminate\Support\Facades\Broadcast;

/*
|------------------------------------------------- -------------------------
| Canales de transmisión
|------------------------------------------------- -------------------------
|
| Aquí podrás registrar todos los canales de transmisión de eventos que tu
| soportes de aplicaciones. Las devoluciones de llamada de autorización de canal dadas son
| Se utiliza para comprobar si un usuario autenticado puede escuchar el canal.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
