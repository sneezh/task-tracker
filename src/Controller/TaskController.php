<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class TaskController extends AbstractController
{
    /**
     * @Route("/api/tasks", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {

    }
}
