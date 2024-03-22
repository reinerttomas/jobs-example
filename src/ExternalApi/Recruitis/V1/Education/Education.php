<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Education;

class Education
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self($data['id'], $data['name']);
    }
}
