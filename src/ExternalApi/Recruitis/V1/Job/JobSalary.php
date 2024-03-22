<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

use App\ExternalApi\Recruitis\V1\Currency;
use App\ExternalApi\Recruitis\V1\Enum\SalaryUnit;

class JobSalary
{
    public function __construct(
        public readonly bool $isRange,
        public readonly bool $isMinVisible,
        public readonly bool $isMaxVisible,
        public readonly float $min,
        public readonly float $max,
        public readonly Currency $currency,
        public readonly SalaryUnit $unit,
        public readonly bool $isVisible,
        public readonly ?string $note,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['is_range'],
            $data['is_min_visible'],
            $data['is_max_visible'],
            $data['min'],
            $data['max'],
            Currency::from($data['currency']),
            SalaryUnit::from($data['unit']),
            $data['visible'],
            $data['note'],
        );
    }
}
