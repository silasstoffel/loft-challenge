<?php

declare(strict_types=1);

namespace Loft\Infra\Caching\Redis;

use Predis\Client;

class RedisClient
{
    private Client $client;

    public function __construct(Client $cacheClient = null, array $parameters = [], array $options = [])
    {
        if ($cacheClient === null) {
            $this->client = new Client($parameters, $options);
        } else {
            $this->client = $cacheClient;
        }
    }

    public function getClient(): Client
    {
        return $this->client;
    }
}
