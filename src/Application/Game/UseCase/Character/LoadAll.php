<?php

declare(strict_types=1);

namespace Loft\Application\Game\UseCase\Character;

use Loft\Domain\Game\Entities\Character;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;

class LoadAll
{
    public function __construct(
        private CharacterRepositoryInterface $repository
    ) {
    }

    /**
     * Load all Characters
     *
     * @return Character[]
     */
    public function execute(): array
    {
        return $this->repository->findAll();
    }
}
