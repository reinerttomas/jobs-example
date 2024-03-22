<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Enum;

enum AccessState: int
{
    case OPEN = 1;
    case CLOSED = 2;
    case ARCHIVED = 3;
    case DRAFT = 4;
    case TEMPLATE = 5;
}
