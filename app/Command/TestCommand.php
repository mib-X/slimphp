<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\UserService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected static $defaultName = 'app:test-command';
    protected function configure(): void
    {
        $this
            // сконфигурировать аргумент
            ->addArgument('userId', InputArgument::REQUIRED, 'The id of the user.')
            // ...
        ;
    }
    public function __construct(private UserService $userService)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = $this->userService->getUserById($input->getArgument('userId'));
        if ($user !== null) {
            $output->writeln("Hello, " .  $user->getName() . "!");
            $output->writeln($user->getName());
        } else {
            $output->writeln("Hello, user doesn't exists!");
            return COMMAND::FAILURE;
        }
        return Command::SUCCESS;
    }
}