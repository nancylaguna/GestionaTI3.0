<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Autenticación Predeterminada
    |--------------------------------------------------------------------------
    |
    | Esta opción controla el "guard" de autenticación predeterminado y las opciones de
    | restablecimiento de contraseña para tu aplicación. Puedes cambiar estos valores
    | según sea necesario, pero son un buen punto de partida para la mayoría de las aplicaciones.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards de Autenticación
    |--------------------------------------------------------------------------
    |
    | A continuación, puedes definir cada guard de autenticación para tu aplicación.
    | Por supuesto, aquí se ha definido una excelente configuración predeterminada
    | que utiliza el almacenamiento de sesión y el proveedor de usuario Eloquent.
    |
    | Todos los controladores de autenticación tienen un proveedor de usuario. Esto define cómo
    | los usuarios se recuperan realmente de tu base de datos u otros mecanismos de almacenamiento
    | utilizados por esta aplicación para persistir los datos de tus usuarios.
    |
    | Soportado: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Proveedores de Usuarios
    |--------------------------------------------------------------------------
    |
    | Todos los controladores de autenticación tienen un proveedor de usuario. Esto define cómo
    | los usuarios se recuperan realmente de tu base de datos u otros mecanismos de almacenamiento
    | utilizados por esta aplicación para persistir los datos de tus usuarios.
    |
    | Si tienes varias tablas o modelos de usuarios, puedes configurar varias
    | fuentes que representen cada modelo / tabla. Estas fuentes pueden luego
    | asignarse a cualquier guardia de autenticación adicional que hayas definido.
    |
    | Soportado: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Restablecimiento de Contraseñas
    |--------------------------------------------------------------------------
    |
    | Puedes especificar múltiples configuraciones de restablecimiento de contraseña si
    | tienes más de una tabla o modelo de usuario en la aplicación y deseas tener
    | configuraciones de restablecimiento de contraseña separadas según los tipos de usuarios específicos.
    |
    | El tiempo de caducidad es la cantidad de minutos que cada token de restablecimiento
    | de contraseña se considerará válido. Esta característica de seguridad mantiene los tokens
    | con una vida corta para que tengan menos tiempo de ser adivinados. Puedes cambiar esto según sea necesario.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tiempo de Expiración de Confirmación de Contraseña
    |--------------------------------------------------------------------------
    |
    | Aquí puedes definir la cantidad de segundos antes de que expire la confirmación de contraseña
    | y se le pida al usuario que vuelva a ingresar su contraseña a través de la
    | pantalla de confirmación. Por defecto, el tiempo de espera dura tres horas.
    |
    */

    'password_timeout' => 10800,

];
