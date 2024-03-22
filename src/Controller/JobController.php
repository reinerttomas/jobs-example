<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JobController extends AbstractController
{
    #[Route('/', name: 'app_job')]
    public function index(): Response
    {
        return $this->render('job/index.html.twig');
    }

    #[Route('/vue', name: 'app_job_vue')]
    public function vue(): Response
    {
        return $this->render('job/index.html.twig');
    }
}
