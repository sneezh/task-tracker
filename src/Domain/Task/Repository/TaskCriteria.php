<?php

declare(strict_types=1);

namespace App\Domain\Task\Repository;

final class TaskCriteria
{
    private int $limit;
    private int $offset;

    /**
     * TaskCriteria constructor.
     * @param int|null $limit
     * @param int|null $offset
     */
    public function __construct(?int $limit = null, ?int $offset = null)
    {
        $this->limit = $limit ?? 20;
        $this->offset = $offset ?? 0;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}
