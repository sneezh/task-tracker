<?php

declare(strict_types=1);

namespace App\Domain\Task\Repository;

use App\Domain\Task\Model\Task;
use Ramsey\Uuid\UuidInterface;

interface TaskRepositoryInterface
{
    /**
     * @param TaskCriteria $criteria
     * @return Task[]
     */
    public function findAllByCriteria(TaskCriteria $criteria): array;

    public function findOneById(UuidInterface $id): ?Task;

    public function findOneByIdOrFail(UuidInterface $id): Task;

    public function findOneByName(string $name): ?Task;

    public function save(Task $task): void;
}
