<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Menu;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController
{
    public function __construct(private Menu $menu, private Twig $twig)
    {
    }

    public function index(Request $request, Response $response, $args): Response
    {
        try {
            return $this->twig->render($response, 'index.twig', [
                'menu' => $this->menu->getMenu()
            ]);
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            echo $e->getMessage();
        }
    }
}
