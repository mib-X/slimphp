<?php

declare(strict_types=1);

namespace App\Service;

use App\Config;

class Menu
{
    public function __construct(private Config $config)
    {
    }
    public function getMenu(): array
    {
        return $this->config->menu;
    }
}