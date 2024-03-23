<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Workfield;

use App\ExternalApi\Recruitis\Meta;

class WorkfieldResponse
{
    public function __construct(
        public readonly Meta $meta,
        /** @var Workfield[] */
        public readonly array $data
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            Meta::fromArray($data['meta']),
            array_map(fn (array $item) => Workfield::fromArray($item), $data['payload']),
        );
    }
}
