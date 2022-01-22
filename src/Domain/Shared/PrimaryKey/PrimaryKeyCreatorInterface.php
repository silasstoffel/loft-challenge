<?php

namespace Loft\Domain\Shared\PrimaryKey;

interface PrimaryKeyCreatorInterface
{
    public function create(): string;
}
