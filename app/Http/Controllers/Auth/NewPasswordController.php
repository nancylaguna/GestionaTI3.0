<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * Muestra la vista de restablecimiento de contraseña.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Maneja una nueva solicitud de contraseña.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación de la solicitud
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
                'min:8', // Asegura que la nueva contraseña tenga al menos 8 caracteres
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/', // Asegura que la nueva contraseña tenga al menos una mayúscula, un número y un carácter especial
            ],
        ]);

        // Intenta restablecer la contraseña del usuario. Si tiene éxito, se
        // actualizará la contraseña en un modelo de usuario real y se persistirá
        // en la base de datos. De lo contrario, se analizará el error y se
        // devolverá la respuesta.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();
                // Dispara el evento de restablecimiento de contraseña
                event(new PasswordReset($user));
            }
        );

        // Si la contraseña se restableció con éxito, redirigimos al usuario de
        // nuevo a la vista autenticada de inicio de la aplicación. Si hay un
        // error, podemos redirigirlos de nuevo de donde vinieron con su mensaje de error.
        return $status == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
