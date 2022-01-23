<?php

namespace Loft\Domain\Game\Repositories;

use Loft\Domain\Game\Entities\Character;

interface CharacterRepositoryInterface
{
    public function create(Character $character): void;

    public function findById(string $id): ?Character;

    public function findByName(string $name): ?Character;
}
