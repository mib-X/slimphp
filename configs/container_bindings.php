<?php

use App\Config;
use App\Service\Menu;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Faker\Factory;
use Slim\Views\Twig;
use Twig\Extra\Intl\IntlExtension;
use function DI\create;

return [
    Config::class => create(Config::class)->constructor($_ENV),
    Factory::class => create(Faker\Factory::class),
//    Menu::class => create(Menu::class)->constructor($container->get(Config::class)),
    Menu::class => function (Config $config) {
    return new Menu($config);
    },
    EntityManager::class => function (Config $dbConfig) {
    $config = ORMSetup::createAttributeMetadataConfiguration([dirname(__DIR__) . '/app/Entity']);
    return new EntityManager(DriverManager::getConnection($dbConfig->db, $config), $config);
},
    Twig::class => function() {
        $twig = Twig::create(VIEW_PATH,
            ['cache' => STORAGE . 'cache',
                'auto_reload' => true
            ]);
        $twig->addExtension(new IntlExtension());
        return $twig;
    }
];