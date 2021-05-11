<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Adapter\Application\EventBus;

use App\Common\Application\EventBus\EventBusInterface;
use App\Common\Domain\EventStoreInterface;
use App\Common\Infrastructure\Messenger\Wrapper\MessengerDispatchWrapperTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class EventBus implements EventBusInterface
{
    use MessengerDispatchWrapperTrait;

    private MessageBusInterface $messageBus;
    private array $events = [];

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function dispatchFromStore(EventStoreInterface $eventStore): void
    {
        $this->events = [...$this->events, ...$eventStore->flushEvents()];
    }

    public function flush(): void
    {
        foreach ($this->events as $event) {
            $this->dispatchWrapped($this->messageBus, $event);
        }

        $this->events = [];
    }
}
