<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Enum;

enum RemoteWork: string
{
    case FULL = 'full';
    case PARTIAL = 'partial';
}
