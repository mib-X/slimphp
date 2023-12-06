<?php

use App\Controller\HomeController;
use App\Controller\PostController;
use App\Controller\UserController;
use DI\Container;
use Slim\App;


return function (App $app, Container $container)
{

    $app->get('/', [HomeController::class, 'index']);
    $app->get('/posts', [PostController::class, 'index']);
    $app->get('/profile/{id:[0-9]+}', [UserController::class, 'index']);
    $app->post('/profile/{id:[0-9]+}', [UserController::class, 'userUpdate']);
};