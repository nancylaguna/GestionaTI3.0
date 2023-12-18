<?php

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

// Prueba: La pantalla para restablecer la contraseña puede ser renderizada
test('la pantalla para restablecer la contraseña puede ser renderizada', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

// Prueba: Se puede solicitar el enlace para restablecer la contraseña
test('se puede solicitar el enlace para restablecer la contraseña', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class);
});

// Prueba: La pantalla para restablecer la contraseña puede ser renderizada
test('la pantalla para restablecer la contraseña puede ser renderizada', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) {
        $response = $this->get('/reset-password/'.$notification->token);

        $response->assertStatus(200);

        return true;
    });
});

// Prueba: La contraseña puede ser restablecida con un token válido
test('la contraseña puede ser restablecida con un token válido', function () {
    Notification::fake();

    $user = User::factory()->create();

    $this->post('/forgot-password', ['email' => $user->email]);

    Notification::assertSentTo($user, ResetPassword::class, function ($notification) use ($user) {
        $response = $this->post('/reset-password', [
            'token' => $notification->token,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasNoErrors();

        return true;
    });
});
