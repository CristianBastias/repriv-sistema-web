<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Valores Predeterminados de Autenticación
    |--------------------------------------------------------------------------
    |
    | Esta opción define el "guard" de autenticación predeterminado y el
    | "broker" de restablecimiento de contraseñas para tu aplicación. Puedes
    | cambiar estos valores según sea necesario, pero son un punto de partida
    | ideal para la mayoría de las aplicaciones.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Guards de Autenticación
    |--------------------------------------------------------------------------
    |
    | A continuación, puedes definir cada guard de autenticación para tu aplicación.
    | Por defecto se incluye una configuración excelente que utiliza almacenamiento
    | en sesión junto con el proveedor de usuarios Eloquent.
    |
    | Todos los guards de autenticación tienen un proveedor de usuarios, el cual
    | define cómo se recuperan realmente los usuarios desde tu base de datos u
    | otro sistema de almacenamiento utilizado por la aplicación.
    |
    | Soportado: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'empresa' => [
            'driver' => 'session',
            'provider' => 'users', // Apunta a 'users' para usar la misma tabla de usuarios
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Proveedores de Usuarios (User Providers)
    |--------------------------------------------------------------------------
    |
    | Todos los guards de autenticación tienen un proveedor de usuarios, que
    | define cómo se obtienen los usuarios desde la base de datos o almacenamiento.
    | Típicamente se utiliza Eloquent.
    |
    | Soportado: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Restablecimiento de Contraseñas
    |--------------------------------------------------------------------------
    |
    | Estas opciones de configuración especifican el comportamiento de la
    | funcionalidad de restablecimiento de contraseña de Laravel, incluyendo
    | la tabla utilizada para el almacenamiento de tokens y el proveedor de
    | usuarios invocado para recuperar a los usuarios.
    |
    | El tiempo de expiración indica los minutos que cada token de restablecimiento
    | será considerado válido. El parámetro throttle define los segundos que
    | un usuario debe esperar antes de generar nuevos tokens.
    |
    */

   'passwords' => [
        // Broker para el panel de Administración (usa la tabla estándar)
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        // Broker para el panel Corporativo / Empresarial (usa la tabla específica de empresas)
        'empresas' => [
            'provider' => 'users',
            'table' => 'empresa_password_reset_tokens', // <--- AQUÍ VA LA TABLA DEL PANEL EMPRESARIAL
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Tiempo de Espera para Confirmación de Contraseña
    |--------------------------------------------------------------------------
    |
    | Aquí puedes definir el número de segundos antes de que la ventana de
    | confirmación de contraseña expire y se le solicite al usuario volver a
    | ingresar su credencial. Por defecto, el tiempo de espera es de tres horas.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
