<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\Menu;
use App\Service\UserService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class UserController
{
    public function __construct(private Menu $menu,
                                private Twig $twig,
                                private UserService $userService)
    {
    }
    public function index(Request $request, Response $response, $args): Response
    {
        $user = $this->userService->getUserById($args['id']);
        if ($user !== null) {
                return $this->twig->render($response, '/profile/profile.twig', [
                    'user' => $user,
                    'menu' => $this->menu->getMenu()
                ]);
        }
            return $this->twig->render($response, '/404/index.twig', [
                'menu' => $this->menu->getMenu()
            ])->withStatus(404);
    }
}