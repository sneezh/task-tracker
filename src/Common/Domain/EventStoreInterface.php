<?php

declare(strict_types=1);

namespace App\Common\Domain;

interface EventStoreInterface
{
    /** @return EventInterface[] */
    public function flushEvents(): iterable;
}
