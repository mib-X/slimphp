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
$builder->addDefinitions(CONFIG_PATH . "/container_bindings.php");
$container = $builder->build();

$routes = require CONFIG_PATH . "/routes.php";

// Set container to create App with on AppFactory
AppFactory::setContainer($container);
$app = AppFactory::create();

$routes($app, $container);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

$app->addRoutingMiddleware();

// This middleware should be added last
$app->addErrorMiddleware(true, true, true);


$app->run();


