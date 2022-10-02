<?php

namespace App\Controller;

use App\Service\ProjectService;
use OpenApi\Annotations as OA;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Model\ProjectListResponse;

class ProjectController extends AbstractController
{
    public function __construct(private readonly ProjectService $projectService)
    {
    }

    /**
     * @OA\Response(
     *     response=200,
     *     description="Returns list of projects",
     *     @Model(type=ProjectListResponse::class)
     * )
     * @OA\Tag(name="Project")
     */
    #[Route(path: '/api/v1/projects', methods: ['GET'])]
    public function getProjects(): Response
    {
        return $this->json($this->projectService->getProjects());
    }

    #[Route(path: '/api/v1/test', methods: ['GET'])]
    public function test(): Response
    {
        return $this->json([
            'status' => 'ok'
        ]);
    }
}
