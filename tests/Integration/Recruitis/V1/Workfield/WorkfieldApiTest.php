<?php

declare(strict_types=1);

namespace App\Tests\Integration\Recruitis\V1\Workfield;

use App\ExternalApi\Recruitis\V1\Workfield\WorkfieldApi;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class WorkfieldApiTest extends KernelTestCase
{
    #[Test]
    #[DataProvider('listOfWorkfieldsProvider')]
    public function it_can_return_list_of_workfields(array $expect, array $body): void
    {
        self::bootKernel();

        // @phpstan-ignore-next-line
        $mockResponse = new MockResponse(json_encode($body));
        $httpClient = new MockHttpClient($mockResponse);

        self::getContainer()->set('http_client.recruitis', $httpClient);

        $response = $this->getWorkfieldApi()->list();

        // Meta
        self::assertEquals($expect['meta']['cached'], $response->meta->cached);
        self::assertEquals($expect['meta']['cachedFrom'], $response->meta->cachedFrom?->format('Y-m-d H:i:s'));
        self::assertEquals($expect['meta']['code'], $response->meta->code);
        self::assertEquals($expect['meta']['duration'], $response->meta->duration);
        self::assertEquals($expect['meta']['message'], $response->meta->message);
        self::assertEquals($expect['meta']['entriesFrom'], $response->meta->entriesFrom);
        self::assertEquals($expect['meta']['entriesTo'], $response->meta->entriesTo);
        self::assertEquals($expect['meta']['entriesTotal'], $response->meta->entriesTotal);
        self::assertEquals($expect['meta']['entriesSum'], $response->meta->entriesSum);

        // Payload
        self::assertSameSize($expect['data'], $response->data);
    }

    public static function listOfWorkfieldsProvider(): iterable
    {
        // cached from api, with count of professions
        yield [
            'expect' => [
                'data' => [
                    [
                        'id' => 1,
                        'name' => 'Workfield 1',
                        'professions' => [
                            [
                                'id' => 1,
                                'name' => 'Profession 1',
                                'count' => 1,
                            ],
                        ],
                    ],
                ],
                'meta' => [
                    'cached' => true,
                    'cachedFrom' => '2024-01-01 00:00:00',
                    'code' => 'code',
                    'duration' => 10,
                    'message' => 'message',
                    'entriesFrom' => 0,
                    'entriesTo' => 1,
                    'entriesTotal' => 1,
                    'entriesSum' => 1,
                ],
            ],
            'body' => [
                'payload' => [
                    [
                        'id' => 1,
                        'name' => 'Workfield 1',
                        'professions' => [
                            [
                                'id' => 1,
                                'name' => 'Profession 1',
                                'count' => 1,
                            ],
                        ],
                    ],
                ],
                'meta' => [
                    'cached' => true,
                    'cached_from' => '2024-01-01 00:00:00',
                    'code' => 'code',
                    'duration' => 10,
                    'message' => 'message',
                    'entries_from' => 0,
                    'entries_to' => 1,
                    'entries_total' => 1,
                    'entries_sum' => 1,
                ],
            ],
        ];

        // non cached from api, without count of professions
        yield [
            'expect' => [
                'data' => [
                    [
                        'id' => 1,
                        'name' => 'Workfield 1',
                        'professions' => [
                            [
                                'id' => 1,
                                'name' => 'Profession 1',
                                'count' => null,
                            ],
                        ],
                    ],
                    [
                        'id' => 2,
                        'name' => 'Workfield 2',
                        'professions' => [
                            [
                                'id' => 1,
                                'name' => 'Profession 1',
                            ],
                            [
                                'id' => 2,
                                'name' => 'Profession 2',
                                'count' => null,
                            ],
                        ],
                    ],
                ],
                'meta' => [
                    'cached' => false,
                    'cachedFrom' => null,
                    'code' => 'code',
                    'duration' => 10,
                    'message' => 'message',
                    'entriesFrom' => 0,
                    'entriesTo' => 2,
                    'entriesTotal' => 2,
                    'entriesSum' => 2,
                ],
            ],
            'body' => [
                'payload' => [
                    [
                        'id' => 1,
                        'name' => 'Workfield 1',
                        'professions' => [
                            [
                                'id' => 1,
                                'name' => 'Profession 1',
                            ],
                        ],
                    ],
                    [
                        'id' => 2,
                        'name' => 'Workfield 2',
                        'professions' => [
                            [
                                'id' => 1,
                                'name' => 'Profession 1',
                            ],
                            [
                                'id' => 2,
                                'name' => 'Profession 2',
                            ],
                        ],
                    ],
                ],
                'meta' => [
                    'cached' => false,
                    'cached_from' => null,
                    'code' => 'code',
                    'duration' => 10,
                    'message' => 'message',
                    'entries_from' => 0,
                    'entries_to' => 2,
                    'entries_total' => 2,
                    'entries_sum' => 2,
                ],
            ],
        ];
    }

    private function getWorkfieldApi(): WorkfieldApi
    {
        return self::getContainer()->get(WorkfieldApi::class);
    }
}
