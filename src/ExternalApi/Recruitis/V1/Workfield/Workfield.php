<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Workfield;

use App\ExternalApi\Recruitis\V1\Profession\Profession;

class Workfield
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        /** @var Profession[] */
        public readonly array $professions,
    ) {
    }

    public static function fromArray(array $data): self
    {
        /** @var Profession[] $professions */
        $professions = [];

        if (isset($data['professions'])) {
            foreach ($data['professions'] as $profession) {
                $professions[] = Profession::fromArray($profession);
            }
        }

        return new self(
            $data['id'],
            $data['name'],
            $professions,
        );
    }
}
