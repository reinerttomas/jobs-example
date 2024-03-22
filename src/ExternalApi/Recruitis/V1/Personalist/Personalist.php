<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Personalist;

class Personalist
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $initials,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['initials'],
        );
    }
}
