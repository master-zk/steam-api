<?php

declare(strict_types=1);

namespace Flame\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Eloquent
{
    public static function boot(): void
    {
        $capsule = new Capsule;
        $capsule->addConnection(self::getConfig());
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    private static function getConfig(): array
    {
        return [
            'driver' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'force'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CONNECTION', 'utf8mb4'),
            'collation' => env('DB_CONNECTION', 'utf8mb4_0900_ai_ci'),
            'prefix' => env('DB_PREFIX', ''),
        ];
    }
}
