<?php

use App\Controller\HomeController;
use App\Controller\PostController;
use App\Service\Menu;
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\Twig;

return function (App $app, Container $container)
{
    $app->get('/', function (Request $request, Response $response, $args) use ($container){
        $menu = $container->get(Menu::class);
        $view = Twig::fromRequest($request);
        return $view->render($response, 'index.twig', ['menu' => $menu->getMenu()]);
    });
    $app->get('/home', [HomeController::class, 'index']);
    $app->get('/posts', [PostController::class, 'index']);
};