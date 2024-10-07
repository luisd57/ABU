<?php

namespace App\Domain\Entity;

use App\Domain\Enum\RoleEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'json')]
    private array $roles;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    public function __construct(string $email, array $roles, string $password, string $name)
    {
        $this->email    = $email;
        $this->roles    = RoleEnum::toArray($roles);
        $this->password = $password;
        $this->name     = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        $roles   = array_map(fn(string $role) => RoleEnum::fromString($role), $this->roles);
        $roles[] = RoleEnum::USER;
        return array_unique(RoleEnum::toArray($roles));
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function withPassword(string $password): self
    {
        $clone           = clone $this;
        $clone->password = $password;
        return $clone;
    }

    public function eraseCredentials(): void
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}