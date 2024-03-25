<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Common\HasLogger;
use App\ExternalApi\Recruitis\V1\Job\Job;
use App\ExternalApi\Recruitis\V1\Job\JobApi;
use App\Http\Resource\JobListResource;
use App\Http\Resource\JobResource;
use App\Http\Resource\PagingResource;
use Exception;
use Nette\Utils\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api')]
class JobController extends AbstractController
{
    use HasLogger;

    #[Route('/jobs', name: 'api_jobs')]
    public function index(
        JobApi $jobApi,
        #[MapQueryParameter] int $limit = 10,
        #[MapQueryParameter] int $page = 1,
    ): Response {
        try {
            $response = $jobApi->list($limit, $page);

            $paginator = new Paginator();
            $paginator->setPage($page);
            $paginator->setItemsPerPage($limit);
            $paginator->setItemCount($response->meta->entriesTotal);
        } catch (Exception $e) {
            $this->logError($e);

            return $this->json([
                'message' => 'Sorry, we couldn\'t retrieve data from the API. Please try again later.',
            ], Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->json(new JobListResource(
            new PagingResource($paginator),
            array_map(fn (Job $job) => new JobResource($job), $response->data),
        ));
    }
}
