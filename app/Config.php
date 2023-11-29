<?php

declare(strict_types=1);

namespace App;

/**
 * @property-read ?array $db
 * @property-read ?array $menu
 */
class Config
{
    protected array $config;
    public function __construct(array $env)
    {
        $this->config = [
            'db' => ['host' => $env['HOST'],
                'user' => $env['DB_USER'],
                'dbname' => $env['DB_NAME'],
                'password' => $env['DB_PASS'],
                'driver' => 'pdo_mysql',
            ],
            'menu' => [
            "/" => 'Home',
            "/posts"=>'Posts',
            "/profile"=>'Profile',
            "/test"=>'Test'
            ]
        ];
    }
    public function __get(string $name): array
    {
        return $this->config[$name] ?? [];
    }
}
