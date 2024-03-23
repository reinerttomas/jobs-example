<?php

declare(strict_types=1);

namespace App\Common;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;
use Throwable;

trait HasLogger
{
    protected LoggerInterface $logger;

    #[Required]
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function logError(Throwable $t): void
    {
        $this->logger->error($t->getMessage(), ['exception' => $t]);
    }
}
