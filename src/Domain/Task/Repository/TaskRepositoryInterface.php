<?php

declare(strict_types=1);

namespace App\Domain\Task\Repository;

use App\Domain\Task\Model\Task;
use App\Domain\Task\Model\TaskCollection;
use Ramsey\Uuid\UuidInterface;

interface TaskRepositoryInterface
{
    /**
     * @param TaskCriteria $criteria
     * @return TaskCollection
     */
    public function findAllByCriteria(TaskCriteria $criteria): TaskCollection;

    public function findOneById(UuidInterface $id): ?Task;

    public function findOneByIdOrFail(UuidInterface $id): Task;

    public function findOneByName(string $name): ?Task;

    public function save(Task $task): void;
}
