<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

class JobReferral
{
    public function __construct(
        public readonly string $rules,
        public readonly string $activity,
        public readonly JobReferralReward $jobReferralReward,
    ) {
    }

    public static function fromArray(array $data): self
    {

        return new self(
            $data['rules'],
            $data['activity'],
            JobReferralReward::fromArray($data['reward']),
        );
    }
}
