<?php

declare(strict_types=1);

namespace App\Http\Resource;

use App\ExternalApi\Recruitis\V1\Job\Job;
use JsonSerializable;

class JobResource implements JsonSerializable
{
    public function __construct(private readonly Job $job)
    {
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->job->jobId,
            'title' => $this->job->title,
            'accessState' => $this->job->accessState->value,
            'dateCreated' => $this->job->dateCreated->format('Y-m-d H:i:s'),
            'publicLink' => $this->job->publicLink,
            'editLink' => $this->job->editLink,
        ];
    }
}
