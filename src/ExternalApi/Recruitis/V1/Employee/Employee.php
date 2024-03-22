<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Employee;

class Employee
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $surname,
        public readonly string $initials,
        public readonly string $email,
        public readonly string $photoUrl,
        public readonly string $phone,
        public readonly string $linkedin,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['surname'],
            $data['initials'],
            $data['email'],
            $data['photo_url'],
            $data['phone'],
            $data['linkedin'],
        );
    }
}
