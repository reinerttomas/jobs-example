<?php

declare(strict_types=1);

namespace App\ExternalApi\Recruitis;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class HttpClient
{
    public function __construct(private readonly HttpClientInterface $httpClient)
    {
    }

    public function get(string $url, array $options = []): ResponseInterface
    {
        return $this->httpClient->request('GET', $url, $options);
    }

    public function post(string $url, array $options): ResponseInterface
    {
        return $this->httpClient->request('POST', $url, $options);
    }

    public function put(string $url, array $options): ResponseInterface
    {
        return $this->httpClient->request('PUT', $url, $options);
    }

    public function delete(string $url, array $options = []): ResponseInterface
    {
        return $this->httpClient->request('DELETE', $url, $options);
    }
}
