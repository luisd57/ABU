<?php

namespace App\Application\Service;

use App\Domain\Entity\User;
use App\Domain\Enum\RoleEnum;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface     $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    ) {}

    public function createUser(string $email, string $plainPassword, string $name, array $roles): User
    {
        $roleEnums      = array_map(fn(string $role) => RoleEnum::fromString($role), $roles);
        $user           = User::create($email, $roleEnums, '', $name);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);
        $user           = $user->withPassword($hashedPassword);

        $this->userRepository->save($user);

        return $user;
    }
}