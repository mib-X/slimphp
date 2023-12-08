<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManager;

class UserService
{
    public function __construct(private EntityManager $entityManager)
    {
    }
    public function getUserById($id)
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }
}