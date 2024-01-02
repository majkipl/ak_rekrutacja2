<?php

namespace App\Core\User\Domain\Event;

use App\Common\EventManager\EventInterface;

class UserCreatedEvent extends AbstractUserEvent implements EventInterface
{

    public function getUserEmail(): string
    {
        return $this->user->getEmail();
    }
}
