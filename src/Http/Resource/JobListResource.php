<?php

declare(strict_types=1);

namespace App\Http\Resource;

use JsonSerializable;

class JobListResource implements JsonSerializable
{
    public function __construct(
        private readonly PagingResource $paging,
        private readonly array $jobs,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'paging' => $this->paging,
            'data' => $this->jobs,
        ];
    }
}
