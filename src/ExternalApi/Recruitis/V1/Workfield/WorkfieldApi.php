<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis\V1\Workfield;

use App\ExternalApi\Recruitis\HttpClient;
use Exception;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;
use Throwable;

class WorkfieldApi
{
    private const WORKFIELDS = '/api2/enums/workfields';

    public function __construct(
        private readonly HttpClient $client,
        private readonly CacheInterface $cache,
    ) {
    }

    /**
     * @throws Exception
     */
    public function list(): WorkfieldResponse
    {
        try {
            $data = $this->cache->get('recruitis_api_workfields', function (ItemInterface $item): array {
                $item->expiresAfter(3600);

                return $this->client
                    ->get(self::WORKFIELDS)
                    ->toArray();
            });

            return WorkfieldResponse::fromArray($data);
        } catch (Throwable $e) {
            throw new Exception($e->getMessage(), $e->getCode(), $e->getPrevious());
        }
    }
}
