<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis;

class Meta
{
    public function __construct(
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
        return new self(
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
