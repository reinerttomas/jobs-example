<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Channel;

use DateTimeImmutable;
use Exception;

class Channel
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?DateTimeImmutable $dateAssigned,
        public readonly ?DateTimeImmutable $dateEnd,
        public readonly ?DateTimeImmutable $dateFrom,
        public readonly bool $active,
        public readonly bool $paused,
    ) {
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): self
    {
        if (is_string($data['date_assigned'])) {
            $dateAssigned = new DateTimeImmutable($data['date_assigned']);
        }

        if (is_string($data['date_end'])) {
            $dateEnd = new DateTimeImmutable($data['date_end']);
        }

        if (is_string($data['date_from'])) {
            $dateFrom = new DateTimeImmutable($data['date_from']);
        }

        return new self(
            $data['id'],
            $data['name'],
            $dateAssigned ?? null,
            $dateEnd ?? null,
            $dateFrom ?? null,
            $data['active'],
            $data['paused'],
        );
    }
}
