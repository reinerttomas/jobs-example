<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis;

use DateTimeImmutable;

class Meta
{
    public function __construct(
        public readonly bool $cached,
        public readonly ?DateTimeImmutable $cachedFrom,
        public readonly string $code,
        public readonly int $duration,
        public readonly string $message,
        public readonly int $entriesFrom,
        public readonly int $entriesTo,
        public readonly int $entriesTotal,
        public readonly int $entriesSum,
    ) {
    }

    public static function fromArray(array $data): self
    {
        if (isset($data['cached_from'])) {
            $cachedFrom = new DateTimeImmutable($data['cached_from']);
        }

        return new self(
            $data['cached'] ?? false,
            $cachedFrom ?? null,
            $data['code'],
            $data['duration'],
            $data['message'],
            $data['entries_from'],
            $data['entries_to'],
            $data['entries_total'],
            $data['entries_sum'],
        );
    }
}
