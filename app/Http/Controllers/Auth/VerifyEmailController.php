<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Marca la dirección de correo electrónico del usuario autenticado como verificada.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Redirige al usuario a la página de inicio si su correo electrónico ya está verificado.
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        // Marca el correo electrónico como verificado y dispara el evento Verified.
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Redirige al usuario a la página de inicio después de la verificación.
        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }
}
