<?php

namespace App\Service;

use App\Entity\Project;
use App\Model\ProjectListItem;
use App\Model\ProjectListResponse;
use App\Repository\ProjectRepository;

class ProjectService
{
    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function getProjects(): ProjectListResponse
    {
        $projects = $this->projectRepository->findAllSortedByCreation();
        $items = array_map(
            fn(Project $project) => new ProjectListItem(
                $project->getId(),
                $project->getTitle(),
                $project->getCreatedAt()
            ),
            $projects
        );

        return new ProjectListResponse($items);
    }
}
