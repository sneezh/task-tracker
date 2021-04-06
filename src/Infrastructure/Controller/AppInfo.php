<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AppInfo
{
    /**
     * @Route("/api/info", methods={"GET"})
     * @SWG\Response(
     *     response=200,
     *     description="Returns the app info",
     *     @SWG\Schema(type="object",
     *         @SWG\Property(property="Name",type="string"),
     *         @SWG\Property(property="Version",type="string"),
     *         @SWG\Property(property="Author",type="string")
     *     )
     * )
     * @SWG\Tag(name="Info")
     */
    public function index(): Response
    {
        $appInfo = [
            'Name' => 'Task Tracker',
            'Version' => '0.0.1',
            'Author' => 'sneezh'
        ];
        return new Response(json_encode($appInfo, JSON_THROW_ON_ERROR));
    }
}
