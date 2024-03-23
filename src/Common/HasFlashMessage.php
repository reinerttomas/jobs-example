<?php

declare(strict_types=1);

namespace App\Common;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @mixin AbstractController
 */
trait HasFlashMessage
{
    private function addFlashSuccess(string $message): void
    {
        $this->addFlash('success', $message);
    }

    private function addFlashWarning(string $message): void
    {
        $this->addFlash('warning', $message);
    }

    private function addFlashDanger(string $message): void
    {
        $this->addFlash('danger', $message);
    }
}
