<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Dotenv\Dotenv;

require_once "./vendor/autoload.php";

$dotenv = Dotenv::createImmutable(__DIR__ . "/app");
$dotenv->load();

$params = ['host' => $_ENV['HOST'],
    'user' => $_ENV['DB_USER'],
    'dbname' => $_ENV['DB_NAME'],
    'password' => $_ENV['DB_PASS'],
    'driver' => 'pdo_mysql'
];

try {
    $connection = DriverManager::getConnection($params);
} catch (Exception $e) {
    echo $e->getMessage();
}

try {
    $entityManager = new EntityManager(
        $connection,
        ORMSetup::createAttributeMetadataConfiguration([__DIR__ . "/app/Entity"])
    );
} catch (MissingMappingDriverImplementation $e) {
    echo $e->getMessage();
}

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);
