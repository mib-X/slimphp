<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/configs/path_constants.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/app");
$dotenv->load();

$builder = new ContainerBuilder();
$builder->addDefinitions(CONFIG_PATH . "/container_bindings.php");
$container = $builder->build();

// Set container to create App with on AppFactory
AppFactory::setContainer($container);
return AppFactory::create();