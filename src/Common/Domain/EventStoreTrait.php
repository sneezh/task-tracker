<?php

declare(strict_types=1);

namespace App\Common\Domain;

trait EventStoreTrait
{
    /** @var EventInterface[] */
    private array $events = [];
    /** @var EventStoreInterface[] */
    private array $childrenStores = [];

    /** @return EventInterface[] */
    public function flushEvents(): iterable
    {
        $storedEvents = [$this->events];
        $this->events = [];

        foreach ($this->childrenStores as $store) {
            $storedEvents[] = $store->flushEvents();
        }

        return array_values(array_merge(...$storedEvents));
    }

    private function addChildrenStore(EventStoreInterface $store): void
    {
        $this->childrenStores[spl_object_hash($store)] = $store;
    }

    private function storeEvent(EventInterface $event): void
    {
        $this->events[spl_object_hash($event)] = $event;
    }
}
