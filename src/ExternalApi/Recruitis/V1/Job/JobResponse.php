<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

use App\ExternalApi\Recruitis\Meta;

class JobResponse
{
    public function __construct(
        public readonly Meta $meta,
        /** @var Job[] */
        public readonly array $data
    ) {
    }

    public static function fromArray(array $data): self
    {
        /** @var Job[] $jobs */
        $jobs = [];

        foreach ($data['payload'] as $jobArray) {
            $jobs[] = Job::fromArray($jobArray);
        }

        return new self(Meta::fromArray($data['meta']), $jobs);
    }
}
