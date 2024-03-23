<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Address;

class Address
{
    public function __construct(
        public readonly int $id,
        public readonly int $officeId,
        public readonly string $city,
        public readonly string $postcode,
        public readonly ?string $street,
        public readonly string $region,
        public readonly string $state,
        public readonly bool $isPrimary,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['office_id'],
            $data['city'],
            $data['postcode'],
            $data['street'],
            $data['region'],
            $data['state'],
            $data['is_primary'],
        );
    }
}
