<?php

namespace Loft\Domain\Game\Repositories;

use Loft\Domain\Game\Entities\CharacterRole;

interface CharacterRoleRepositoryInterface
{
    public function findAll(): array;

    public function findById(string $id): ?CharacterRole;

    public function create(CharacterRole $characterRole);
}
