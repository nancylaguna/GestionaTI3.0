<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Maneja una solicitud de registro entrante.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
                'min:8', // Asegura que la nueva contraseña tenga al menos 8 caracteres
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/', // Asegura que la nueva contraseña tenga al menos una mayúscula, un número y un carácter especial
            ],
        ]);
        // Crear un nuevo usuario en la base de datos con los datos proporcionados por el formulario de registro
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Disparar el evento "Registered" para manejar acciones adicionales después del registro
        event(new Registered($user));
        // Iniciar sesión al usuario recién registrado
        Auth::login($user);
        // Redireccionar al usuario a la página de inicio después del registro
        return redirect(RouteServiceProvider::HOME);
    }
}
