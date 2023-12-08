<?php

use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$app = require_once __DIR__ . "/../bootstrap.php";
$container = $app->getContainer();
$routes = require CONFIG_PATH . "/routes.php";

$routes($app, $container);

// Add Twig-View Middleware
$app->add(TwigMiddleware::create($app, $container->get(Twig::class)));

$app->addRoutingMiddleware();

// This middleware should be added last
$app->addErrorMiddleware(true, true, true);

$app->run();


