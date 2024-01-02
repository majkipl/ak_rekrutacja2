<?php

namespace App\Core\User\Application\EventListener;

use App\Core\User\Domain\Event\UserCreatedEvent;
use App\Core\User\Domain\Notification\NotificationInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class SendEmailUserCreatedEventSubscriberListener implements EventSubscriberInterface
{
    public function __construct(
        private readonly NotificationInterface $mailer
    )
    {
    }

    public function send(UserCreatedEvent $event): void
    {
        $userEmail = $event->getUserEmail();
        $this->mailer->sendEmail(
            $userEmail,
            'Rejestracja konta w systemie',
            'Zarejestrowano konto w systemie. Aktywacja konta trwa do 24h.'
        );
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UserCreatedEvent::class => 'send'
        ];
    }
}
