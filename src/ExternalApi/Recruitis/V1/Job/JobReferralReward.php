<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

class JobReferralReward
{
    public function __construct(
        public readonly int $amount,
        public readonly string $currency,
        public readonly string $reward,
        public readonly string $type,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['amount'],
            $data['currency'],
            $data['reward'],
            $data['type'],
        );
    }
}
