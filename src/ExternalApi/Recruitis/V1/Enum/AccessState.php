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

    public function description(): string
    {
        return match ($this) {
            self::OPEN => 'Open',
            self::CLOSED => 'Closed',
            self::ARCHIVED => 'Archived',
            self::DRAFT => 'Draft',
            self::TEMPLATE => 'Template',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::OPEN => 'success',
            self::CLOSED => 'danger',
            self::ARCHIVED => 'warning',
            self::DRAFT => 'info',
            self::TEMPLATE => 'secondary',
        };
    }
}
