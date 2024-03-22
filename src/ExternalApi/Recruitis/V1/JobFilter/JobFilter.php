<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\JobFilter;

class JobFilter
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $group,
        public readonly int $groupId,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['group'],
            $data['group_id'],
        );
    }
}
