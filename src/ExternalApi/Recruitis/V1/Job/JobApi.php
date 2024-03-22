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
    public function list(): JobResponse
    {
        $response = $this->client->get(self::JOBS);

        try {
            return JobResponse::fromArray($response->toArray());
        } catch (Throwable $e) {
            throw new Exception('List jobs error.', $e->getCode(), $e->getPrevious());
        }
    }
}
