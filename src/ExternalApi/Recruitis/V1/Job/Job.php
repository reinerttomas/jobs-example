<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

use App\ExternalApi\Recruitis\V1\Address\Address;
use App\ExternalApi\Recruitis\V1\Channel\Channel;
use App\ExternalApi\Recruitis\V1\Education\Education;
use App\ExternalApi\Recruitis\V1\Employment\Employment;
use App\ExternalApi\Recruitis\V1\Enum\AccessState;
use App\ExternalApi\Recruitis\V1\JobFilter\JobFilter;
use App\ExternalApi\Recruitis\V1\Personalist\Personalist;
use App\ExternalApi\Recruitis\V1\Workfield\Workfield;
use DateTimeImmutable;
use Exception;

class Job
{
    public function __construct(
        public readonly int $jobId,
        public readonly string $securedId,
        public readonly ?string $publicId,
        public readonly AccessState $accessState,
        public readonly bool $draft,
        public readonly bool $active,
        public readonly string $title,
        public readonly string $description,
        public readonly ?string $internalNote,
        public readonly ?DateTimeImmutable $dateEnd,
        public readonly ?DateTimeImmutable $dateClosed,
        public readonly int $closedDuration,
        public readonly DateTimeImmutable $dateCreated,
        public readonly DateTimeImmutable $dateCreatedOrigin,
        public readonly DateTimeImmutable $lastUpdate,
        public readonly string $textLanguage,
        /** @var Workfield[] $workfields */
        public readonly array $workfields,
        /** @var JobFilter[] $jobFilters */
        public readonly array $jobFilters,
        public readonly Education $education,
        public readonly ?bool $disability,
        public readonly ?JobDetail $details,
        public readonly Personalist $personalist,
        public readonly JobContact $contact,
        /** @var Address[] $addresses */
        public readonly array $addresses,
        /** @var Employment[] $employments */
        public readonly array $employments,
        public readonly ?JobStats $jobStats,
        public readonly ?JobSalary $salary,
        /** @var Channel[] $channels */
        public readonly array $channels,
        public readonly string $editLink,
        public readonly string $publicLink,
        /** @var JobReferral[] $referrals */
        public readonly array $referrals,
    ) {
    }

    /**
     * @throws Exception
     */
    public static function fromArray(array $data): self
    {
        if (isset($data['date_end'])) {
            $dateEnd = new DateTimeImmutable($data['date_end']);
        }

        if (isset($data['date_closed'])) {
            $dateClosed = new DateTimeImmutable($data['date_closed']);
        }

        // podle dokumentace není nullable
        if (isset($data['closed_duration'])) {
            $closedDuration = $data['closed_duration'];
        }

        /** @var Workfield[] $workfields */
        $workfields = [];

        foreach ($data['workfields'] as $workfield) {
            $workfields[] = Workfield::fromArray($workfield);
        }

        /** @var JobFilter[] $jobFilters */
        $jobFilters = [];

        foreach ($data['filterlist'] as $filter) {
            $jobFilters[] = JobFilter::fromArray($filter);
        }

        if (isset($data['details'])) {
            $jobDetail = JobDetail::fromArray($data['details']);
        }

        /** @var Address[] $addresses */
        $addresses = [];

        foreach ($data['addresses'] as $address) {
            $addresses[] = Address::fromArray($address);
        }

        // TODO: workaround, dle dokumentace má vracet Employment[], ale vrací Employment
        if (is_array(reset($data['employment']))) {
            $employments = array_map(fn (array $item): Employment => Employment::fromArray($item), $data['employment']);
        } else {
            $employments = [Employment::fromArray($data['employment'])];
        }

        if (isset($data['stats'])) {
            $jobStats = JobStats::fromArray($data['stats']);
        }

        if (isset($data['salary'])) {
            $salary = JobSalary::fromArray($data['salary']);
        }

        /** @var Channel[] $channels */
        $channels = [];

        foreach ($data['channels'] as $ident => $channel) {
            $channels[$ident] = Channel::fromArray($channel);
        }

        return new self(
            $data['job_id'],
            $data['secured_id'],
            $data['public_id'],
            AccessState::from($data['access_state']),
            $data['draft'],
            $data['active'],
            $data['title'],
            $data['description'],
            $data['internal_note|string'],
            $dateEnd ?? null,
            $dateClosed ?? null,
            $closedDuration ?? 0,
            new DateTimeImmutable($data['date_created']),
            new DateTimeImmutable($data['date_created_origin']),
            new DateTimeImmutable($data['last_update']),
            $data['text_language'],
            $workfields,
            $jobFilters,
            Education::fromArray($data['education']),
            $data['disability'],
            $jobDetail ?? null,
            Personalist::fromArray($data['personalist']),
            JobContact::fromArray($data['contact']),
            $addresses,
            $employments,
            $jobStats ?? null,
            $salary ?? null,
            $channels,
            $data['edit_link'],
            $data['public_link'],
            array_map(fn (array $item): JobReferral => JobReferral::fromArray($item), $data['referrals']),
        );
    }
}
