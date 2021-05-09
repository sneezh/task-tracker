<?php

declare(strict_types=1);

namespace App\Domain\Task\Model;

final class TaskCollection
{
    /** @var Task[] */
    private iterable $tasks;

    public function __construct(Task ...$tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * @return Task[]
     */
    public function getTasks(): array
    {
        return $this->tasks;
    }
}
