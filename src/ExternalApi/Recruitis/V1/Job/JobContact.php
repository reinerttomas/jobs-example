<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

use App\ExternalApi\Recruitis\V1\Employee\Employee;

class JobContact
{
    public function __construct(
        public readonly string $name,
        public readonly string $initials,
        public readonly string $email,
        public readonly ?string $phone,
        public readonly ?Employee $employee,
    ) {
    }

    public static function fromArray(array $data): self
    {
        if (isset($data['employee'])) {
            $employee = Employee::fromArray($data['employee']);
        }

        return new self(
            $data['name'],
            $data['initials'],
            $data['email'],
            $data['phone'],
            $employee ?? null,
        );
    }
}
