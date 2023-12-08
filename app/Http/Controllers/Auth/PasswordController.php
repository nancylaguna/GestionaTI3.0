<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

use Illuminate\Validation\Rule;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                Password::defaults(),
                'confirmed',
                'min:8', // Asegura que la nueva contraseña tenga al menos 8 caracteres
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_])/', // Asegura que la nueva contraseña tenga al menos una mayúscula, un número y un carácter especial
                Rule::notIn([$user->password]), // Asegura que la nueva contraseña no sea igual a la anterior
            ],
        ],
        [
            'password.regex' => 'La contraseña debe contener al menos una mayúscula, un número y un carácter especial.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.not_in' => 'La contraseña no puede ser igual a la contraseña anterior.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
