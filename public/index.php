<?php

use DI\ContainerBuilder;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Twig\Extra\Intl\IntlExtension;


require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../configs/path_constants.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__) . "/app");
$dotenv->load();

$builder = new ContainerBuilder();
$builder->addDefinitions(__DIR__ . "/../configs/container_bindings.php");
$container = $builder->build();

$routes = require __DIR__ . "/../configs/routes.php";

// Set container to create App with on AppFactory
AppFactory::setContainer($container);
$app = AppFactory::create();

// Create Twig
$twig = Twig::create(__DIR__ . '/../views',
    ['cache' => STORAGE . 'cache',
        'auto_reload' => true
    ]);
$twig->addExtension(new IntlExtension());

$routes($app, $container);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $twig));

try {
$app->run();
} catch (HttpNotFoundException $e) {
    echo $e->getTitle();
    echo $e->getDescription();
}

