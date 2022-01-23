<?php

declare(strict_types=1);

namespace Loft\Application\Game\UseCase\Character;

use Loft\Domain\Game\Entities\Character;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;
use Loft\Domain\Game\Repositories\CharacterRoleRepositoryInterface;
use Loft\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;

class Create
{
    public function __construct(
        private CharacterRepositoryInterface $characterRepository,
        private CharacterRoleRepositoryInterface $characterRoleRepository,
        private PrimaryKeyCreatorInterface $primaryKeyCreator
    ) {
    }

    public function execute(CreateDTO $create): Character
    {
        $this->check($create);

        $entity = Character::fromArray([
            'id'     => $this->primaryKeyCreator->create(),
            'name'   => $create->name,
            'roleId' => $create->role,
        ]);

        $this->characterRepository->create($entity);

        return $entity;
    }

    private function check(CreateDTO $create)
    {
        $role = $this->characterRoleRepository->findById($create->role);

        if (is_null($role)) {
            throw  new \InvalidArgumentException('Invalid argument role or role not exists.');
        }

        if (!is_null($this->characterRepository->findByName($create->name))) {
            throw new \DomainException('Name already exists.');
        }
    }
}
