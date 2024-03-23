<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Enum;

enum Currency: string
{
    case CZK = 'CZK';
    case USD = 'USD';
    case EUR = 'EUR';
}
