<?php

namespace App\Core\User\UserInterface\Cli;

use App\Core\User\Application\DTO\UserDTO;
use App\Core\User\Application\Query\GetInactiveUsersEmails\GetInactiveUsersEmailsQuery;
use App\Common\Bus\QueryBusInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:user:get-inactive-emails',
    description: 'Pobiera e-maile nieaktywnych użytkowników'
)]
class GetInactiveUsersEmails extends Command
{
    public function __construct(private readonly QueryBusInterface $bus)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inactiveUserEmails = $this->bus->dispatch(new GetInactiveUsersEmailsQuery());

        /** @var UserDTO $user */
        foreach ($inactiveUserEmails as $user) {
            $output->writeln($user->getEmail());
        }

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
    }
}
