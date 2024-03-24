<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\ExternalApi\Recruitis\Meta;
use App\ExternalApi\Recruitis\V1\Job\JobApi;
use App\ExternalApi\Recruitis\V1\Job\JobResponse;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobControllerTest extends WebTestCase
{
    #[Test]
    public function it_can_access_jobs(): void
    {
        $client = static::createClient();

        $jobApi = $this->createMock(JobApi::class);
        $jobApi->expects(self::once())
            ->method('list')
            ->willReturn($this->getJobResponse());

        self::getContainer()->set(JobApi::class, $jobApi);

        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorNotExists('.card');
    }

    private function getJobResponse(): JobResponse
    {
        return new JobResponse(
            new Meta(
                false,
                null,
                'code',
                100,
                'message',
                0,
                0,
                0,
                0,
            ),
            []
        );
    }
}
