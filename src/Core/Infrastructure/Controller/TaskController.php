<?php

declare(strict_types=1);

namespace App\Core\Infrastructure\Controller;

use App\Core\Domain\Repository\TaskCriteria;
use App\Core\Domain\Repository\TaskRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class TaskController extends AbstractController
{
    /**
     * @Route("/api/tasks", methods={"GET"})
     *
     * @param TaskRepositoryInterface $taskRepository
     * @param int|null $limit
     * @param int|null $offset
     * @return JsonResponse
     */
    public function list(
        TaskRepositoryInterface $taskRepository,
        ?int $limit = null,
        ?int $offset = null
    ): JsonResponse {
        return $this->json($taskRepository->findAllByCriteria(new TaskCriteria($limit, $offset)));
    }
}
