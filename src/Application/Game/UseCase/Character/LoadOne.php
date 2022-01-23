<?php

declare(strict_types=1);

namespace Loft\Application\Game\UseCase\Character;

use Loft\Domain\Game\Entities\Character;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;

class LoadOne
{
    public function __construct(
        private CharacterRepositoryInterface $repository
    ) {
    }

    public function execute(string $id): ?Character
    {
        return $this->repository->findById($id);
    }
}
