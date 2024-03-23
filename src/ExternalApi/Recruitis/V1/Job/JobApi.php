<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Job;

use App\ExternalApi\Recruitis\HttpClient;
use Exception;
use Throwable;

class JobApi
{
    private const JOBS = '/api2/jobs';

    public function __construct(private readonly HttpClient $client)
    {
    }

    /**
     * @throws Exception
     */
    public function list(int $limit, int $page): JobResponse
    {
        $response = $this->client->get(self::JOBS, [
            'query' => [
                'limit' => $limit,
                'page' => $page,
            ],
        ]);

        try {
            return JobResponse::fromArray($response->toArray());
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
