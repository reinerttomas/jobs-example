<?php

declare(strict_types=1);

namespace App\Controller;

use App\Common\HasFlashMessage;
use App\Common\HasLogger;
use App\ExternalApi\Recruitis\V1\Job\JobApi;
use Exception;
use Nette\Utils\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class JobController extends AbstractController
{
    use HasFlashMessage;
    use HasLogger;

    #[Route('/', name: 'app_job')]
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
            $this->addFlashDanger("Sorry, we couldn't retrieve data from the API. Please try again later.");
        }

        return $this->render('job/index.html.twig', [
            'jobs' => $response->data ?? [],
            'paginator' => $paginator ?? null,
        ]);
    }

    #[Route('/vue', name: 'app_job_vue')]
    public function vue(): Response
    {
        return $this->render('job/index.html.twig');
    }
}
