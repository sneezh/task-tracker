<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Adapter\Application\CommandBus;

use App\Common\Application\CommandBus\CommandBusInterface;
use App\Common\Infrastructure\Messenger\Wrapper\MessengerDispatchWrapperTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class CommandBus implements CommandBusInterface
{
    use MessengerDispatchWrapperTrait;

    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function handle(object $command): void
    {
        $this->dispatchWrapped($this->messageBus, $command);
    }
}
