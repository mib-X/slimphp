<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Service\Menu;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class UserController
{
    public function __construct(private Menu $menu, private Twig $twig, private EntityManager $entityManager )
    {
    }
    public function index(Request $request, Response $response, $args): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($args['id']);
        if ($user !== null) {
            try {
                return $this->twig->render($response, '/profile/profile.twig', [
                    'user' => $user,
                    'menu' => $this->menu->getMenu()
                ]);
            } catch (LoaderError | RuntimeError | SyntaxError $e) {
                echo $e->getMessage();
            }
        } else {
            try {
                return $this->twig->render($response, '/404/index.twig', [
                    'menu' => $this->menu->getMenu()
                ])->withStatus(404);
            } catch (LoaderError | RuntimeError | SyntaxError $e) {
                echo $e->getMessage();
            }
        }

    }
}