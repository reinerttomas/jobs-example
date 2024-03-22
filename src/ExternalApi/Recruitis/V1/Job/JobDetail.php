<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

use App\ExternalApi\Recruitis\V1\Enum\DrivingLicense;
use App\ExternalApi\Recruitis\V1\Enum\RemoteWork;
use App\ExternalApi\Recruitis\V1\SuitableFor\SuitableFor;

class JobDetail
{
    public function __construct(
        /** @deprecated  */
        public readonly ?int $officeId,
        public readonly ?string $facebookPicturePath,
        public readonly ?string $openingReason,
        public readonly ?RemoteWork $remoteWork,
        /** @var SuitableFor[] $suitableFor */
        public readonly array $suitableFor,
        /** @var DrivingLicense[] $drivingLicense */
        public readonly array $drivingLicense,
    ) {
    }

    public static function fromArray(array $data): self
    {
        /** @var SuitableFor[] $suitableForList */
        $suitableForList = [];

        if (isset($data['driving_license'])) {
            foreach ($data['driving_license'] as $suitableFor) {
                $suitableForList[] = SuitableFor::fromArray($suitableFor);
            }
        }

        if (isset($data['remote_work'])) {
            $remoteWork = RemoteWork::from($data['remote_work']);
        }

        /** @var DrivingLicense[] $drivingLicenseList */
        $drivingLicenseList = [];

        if (isset($data['driving_license'])) {
            foreach ($data['driving_license'] as $drivingLicense) {
                $drivingLicenseList[] = DrivingLicense::from($drivingLicense);
            }
        }

        return new self(
            $data['office_id'],
            $data['facebook_picture_path'],
            $data['opening_reason'],
            $remoteWork ?? null,
            $suitableForList,
            $drivingLicenseList,
        );
    }
}
