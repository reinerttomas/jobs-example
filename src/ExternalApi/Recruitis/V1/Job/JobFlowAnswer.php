<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

class JobFlowAnswer
{
    public function __construct(
        public readonly int $action,
        public readonly int $flowId,
        public readonly int $answers,
        public readonly string $name,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['action'],
            $data['flow_id'],
            $data['answers'],
            $data['name'],
        );
    }
}
