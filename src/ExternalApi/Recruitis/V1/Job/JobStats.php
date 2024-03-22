<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

class JobStats
{
    public function __construct(
        public readonly int $answers,
        public readonly int $views,
        /** @var JobFlowAnswer[] */
        public readonly array $flowAnswers,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['answers'],
            $data['views'],
            $data['flow_answers'],
        );
    }
}
