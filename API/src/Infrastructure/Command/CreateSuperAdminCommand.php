<?php

namespace App\Infrastructure\Command;

use App\Domain\Entity\User;
use App\Domain\Enum\RoleEnum;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name       : 'app:create-super-admin',
    description: 'Creates a new super admin user',
)]
class CreateSuperAdminCommand extends Command
{
    public function __construct(
        private UserRepositoryInterface     $userRepository,
        private UserPasswordHasherInterface $passwordHasher
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $emailQuestion = new Question('Please enter the email for the super admin: ');
        $email         = $helper->ask($input, $output, $emailQuestion);

        $passwordQuestion = new Question('Please enter the password for the super admin: ');
        $passwordQuestion->setHidden(true);
        $passwordQuestion->setHiddenFallback(false);
        $password = $helper->ask($input, $output, $passwordQuestion);

        $nameQuestion = new Question('Please enter the name for the super admin: ');
        $name         = $helper->ask($input, $output, $nameQuestion);

        // Create user with all roles
        $user = new User(
            $email,
            [RoleEnum::ADMIN, RoleEnum::THERAPIST, RoleEnum::USER],
            $this->passwordHasher->hashPassword(new User($email, [], '', $name), $password),
            $name
        );

        $this->userRepository->save($user);

        $output->writeln('Super admin user created successfully!');

        return Command::SUCCESS;
    }
}