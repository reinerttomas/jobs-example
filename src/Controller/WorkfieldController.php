<?php

declare(strict_types=1);

namespace App\Controller;

use App\Common\HasFlashMessage;
use App\Common\HasLogger;
use App\ExternalApi\Recruitis\V1\Workfield\WorkfieldApi;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WorkfieldController extends AbstractController
{
    use HasFlashMessage;
    use HasLogger;

    #[Route('/workfield', name: 'app_workfield')]
    public function index(WorkfieldApi $workfieldApi): Response
    {
        try {
            $response = $workfieldApi->list();
        } catch (Exception $e) {
            $this->logError($e);
            $this->addFlashDanger("Sorry, we couldn't retrieve data from the API. Please try again later.");
        }

        return $this->render('workfield/index.html.twig', [
            'workfields' => $response->data ?? [],
            'total' => $response->meta->entriesTotal ?? 0,
        ]);
    }
}
