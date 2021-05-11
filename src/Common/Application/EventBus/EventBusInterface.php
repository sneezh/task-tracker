<?php

declare(strict_types=1);

namespace App\Common\Application\EventBus;

use App\Common\Domain\EventStoreInterface;

interface EventBusInterface
{
    public function dispatchFromStore(EventStoreInterface $eventStore): void;
}
