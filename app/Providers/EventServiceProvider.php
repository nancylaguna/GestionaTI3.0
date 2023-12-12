<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Las asignaciones de eventos a escuchadores para la aplicación.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Registra cualquier evento para tu aplicación.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determina si los eventos y los escuchadores deben descubrirse automáticamente.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
