<?php

declare(strict_types=1);

namespace App\Providers\Dependencies\Domain;

use Illuminate\Support\ServiceProvider;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;
use Loft\Domain\Game\Repositories\CharacterRoleRepositoryInterface;
use Loft\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;
use Loft\Infra\Caching\Redis\RedisClient;
use Loft\Infra\Domain\Game\Repositories\CharacterRepository;
use Loft\Infra\Domain\Game\Repositories\CharacterRoleRepository;
use Loft\Infra\Shared\PrimaryKey\UUIDCreator;

final class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->repositories();
        $this->common();
    }

    public function repositories(): void
    {
        $this->app->bind(
            CharacterRoleRepositoryInterface::class,
            fn($app) => new CharacterRoleRepository()
        );

        $this->app->bind(
            CharacterRepositoryInterface::class,
            fn($app) => new CharacterRepository(
                $this->app->get(RedisClient::class)
            )
        );
    }

    public function common(): void
    {
        $this->app->bind(
            PrimaryKeyCreatorInterface::class, fn() => new UUIDCreator()
        );
    }
}
