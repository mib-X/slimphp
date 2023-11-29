<?php

declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'users')]
class User
{
    #[Id, Column(name:'id', type: Types::INTEGER, precision: 10), GeneratedValue]
    private int $id;

    #[Column(unique: true) ]
    private string $email;

    #[Column(name:'name')]
    private string $name;

    #[Column(name: 'is_active', type: Types::SMALLINT, precision: 6)]
    private bool $isActive;

    #[Column(name:'created_at', type: TYPES::DATETIME_MUTABLE)]
    private DateTime $createdAt;

    #[Column]
    private string $image;

    #[Column]
    private string $password;

    #[Column(type: Types::DATETIME_MUTABLE)]
    private DateTime $birthday;

    #[OneToMany(mappedBy: 'user', targetEntity: Post::class, cascade: ['persist', 'remove'])]
    private Collection $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): User
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }
    public function getPosts(): Collection
    {
        return $this->posts;
    }
    public function addPost(Post $post)
    {
        $post->setUser($this);
        $this->posts->add($post);
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): User
    {
        $this->name = $name;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): User
    {
        $this->image = $image;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday): User
    {
        $this->birthday = $birthday;
        return $this;
    }

}
