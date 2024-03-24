<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\ExternalApi\Recruitis\Meta;
use App\ExternalApi\Recruitis\V1\Profession\Profession;
use App\ExternalApi\Recruitis\V1\Workfield\Workfield;
use App\ExternalApi\Recruitis\V1\Workfield\WorkfieldApi;
use App\ExternalApi\Recruitis\V1\Workfield\WorkfieldResponse;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WorkfieldControllerTest extends WebTestCase
{
    #[Test]
    public function it_can_access_workfields(): void
    {
        $client = static::createClient();

        $workfieldApi = $this->createMock(WorkfieldApi::class);
        $workfieldApi->expects(self::once())
            ->method('list')
            ->willReturn($this->getWorkfieldResponse());

        self::getContainer()->set(WorkfieldApi::class, $workfieldApi);

        $crawler = $client->request('GET', '/workfield');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('.card-header', 'Workfields (2)');
        self::assertCount(2, $crawler->filter('table > tbody > tr'));
    }

    private function getWorkfieldResponse(): WorkfieldResponse
    {
        return new WorkfieldResponse(
            new Meta(
                false,
                null,
                'code',
                100,
                'message',
                0,
                2,
                2,
                2,
            ),
            [
                new Workfield(
                    1,
                    'Workfield 1',
                    [
                        new Profession(
                            1,
                            'Profession 1',
                            10,
                        ),
                    ]
                ),
                new Workfield(
                    2,
                    'Workfield 2',
                    [
                        new Profession(
                            1,
                            'Profession 1',
                            5,
                        ),
                        new Profession(
                            2,
                            'Profession 2',
                            10,
                        ),
                    ]
                ),
            ]
        );
    }
}
