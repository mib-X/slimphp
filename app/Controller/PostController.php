<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Service\Menu;
use Doctrine\ORM\EntityManager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostController
{
    public function __construct(private EntityManager $entityManager, private Menu $menu, private Twig $twig)
    {

    }
    public function index(Request $request, Response $response, $args): Response
    {
        $em = $this->entityManager;

        $posts = $em->getRepository(Post::class)->findall();

        return $this->twig->render($response, '/posts/posts.twig', [
            'posts' => $posts, 'menu' => $this->menu->getMenu()
        ]);
    }
}