<?php

declare(strict_types=1);

namespace App\Providers\Dependencies\Domain;

use Loft\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;
use Loft\Infra\Shared\PrimaryKey\UUIDCreator;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->repositories();
        $this->common();
    }

    public function repositories(): void
    {
        //$this->app->bind(UserRepositoryInterface::class, fn() => new UserRepository());
    }

    public function common(): void
    {
        $this->app->bind(
            PrimaryKeyCreatorInterface::class, fn() => new UUIDCreator()
        );
    }
}
