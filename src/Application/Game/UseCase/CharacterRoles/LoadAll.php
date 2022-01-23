<?php

namespace Loft\Application\Game\UseCase\CharacterRoles;

use Loft\Domain\Game\Entities\CharacterRole;
use Loft\Domain\Game\Repositories\CharacterRoleRepositoryInterface;

class LoadAll
{
    public function __construct(
        private CharacterRoleRepositoryInterface $repository
    ) {
    }

    /**
     * Load all character role
     * @return CharacterRole[]
     */
    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
