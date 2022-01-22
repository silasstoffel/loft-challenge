<?php

namespace Loft\Infra\Shared\PrimaryKey;

use Loft\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;
use Ramsey\Uuid\Uuid;

class UUIDCreator implements PrimaryKeyCreatorInterface
{
    public function create(): string
    {
        return Uuid::uuid4();
    }
}
