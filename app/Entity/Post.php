<?php


namespace App\Entity;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:'posts')]
class Post
{
    #[Id, Column(name:'id', type: Types::INTEGER), GeneratedValue]
    private int $id;

    #[Column]
    private string $title;

    #[Column(type: Types::TEXT, nullable: true)]
    private string $description;

    #[Column(type: Types::STRING, nullable: true)]
    private string $thumb;

    #[Column(name:'created_at', type: Types::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    #[Column(name:'user_id', type: Types::INTEGER)]
    private int $userId;

    #[ManyToOne(targetEntity: User::class, inversedBy: 'posts')]
    private User $user;

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Post
    {
        $this->description = $description;
        return $this;
    }

    public function getThumb(): string
    {
        return $this->thumb;
    }

    public function setThumb(string $thumb): Post
    {
        $this->thumb = $thumb;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): Post
    {
        $this->createdAt = $createdAt;
        return $this;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }


    public function setUserId(int $userId): Post
    {
        $this->userId = $userId;
        return $this;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): Post
    {
        $this->user = $user;
        return $this;
    }



}