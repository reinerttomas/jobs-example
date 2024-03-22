<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Enum;

enum SalaryUnit: string
{
    case MONTH = 'month';
    case HOUR = 'hour';
    case MANDAY = 'manday';
}
