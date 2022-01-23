<?php

declare(strict_types=1);

namespace App\Providers\Dependencies\Infra;

use Predis\Client;
use Illuminate\Support\ServiceProvider;
use Loft\Infra\Caching\Redis\RedisClient;

class InfraServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->redis();
    }

    private function redis()
    {
        $client = new Client([
            'scheme' => env('REDIS_SCHEME', 'tcp'),
            'host'   => env('REDIS_HOST', '127.0.0.1'),
            'port'   => env('REDIS_PORT', 6379),
        ]);

        $this->app->bind(
            RedisClient::class,
            fn($app) => new RedisClient($client)
        );
    }
}
