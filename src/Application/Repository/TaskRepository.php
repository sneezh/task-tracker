<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Application\Common\Exception\NotImplementedException;
use App\Domain\Task\Model\Task;
use App\Domain\Task\Repository\TaskCriteria;
use App\Domain\Task\Repository\TaskRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

final class TaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @inheritDoc
     */
    public function findAllByCriteria(TaskCriteria $criteria): array
    {
        $qb = $this->createQueryBuilder('task');

        $qb
            ->orderBy('task.createdAt', 'DESC')
            ->setFirstResult($criteria->getOffset())
            ->setMaxResults($criteria->getLimit());

        $query = $qb->getQuery();

        return $query->getResult();
    }

    public function findOneById(UuidInterface $id): ?Task
    {
        return null;
    }

    /**
     * @param UuidInterface $id
     * @return Task
     * @throws NotImplementedException
     */
    public function findOneByIdOrFail(UuidInterface $id): Task
    {
        throw new NotImplementedException();
    }

    public function findOneByName(string $name): ?Task
    {
        return null;
    }

    public function save(Task $task): void
    {
        $this->getEntityManager()->persist($task);
    }

    public function flush(): void
    {
        $this->getEntityManager()->flush();
    }
}
