<?php

namespace App\Core\User\Application\Query\GetInactiveUsersEmails;

use App\Core\User\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetInactiveUsersEmailsHandler
{
    public function __construct(private readonly UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(GetInactiveUsersEmailsQuery $query): array
    {
        $inactiveUsers = $this->userRepository->findInactiveUsers();

        return $inactiveUsers;
    }
}
