<?php

declare(strict_types=1);

namespace Loft\Application\Game\UseCase\Character;

use Loft\Domain\Game\Entities\Character;
use Loft\Domain\Game\Entities\CharacterBuilder;
use Loft\Domain\Game\Entities\CharacterRole;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;
use Loft\Domain\Game\Repositories\CharacterRoleRepositoryInterface;
use Loft\Domain\Shared\PrimaryKey\PrimaryKeyCreatorInterface;

class Create
{
    private CharacterRole $currentRole;

    public function __construct(
        private CharacterRepositoryInterface $characterRepository,
        private CharacterRoleRepositoryInterface $characterRoleRepository,
        private PrimaryKeyCreatorInterface $primaryKeyCreator
    ) {
    }

    public function execute(CreateDTO $create): Character
    {
        $this->check($create);

        $builder = new CharacterBuilder();
        $entity  = $builder
            ->id($this->primaryKeyCreator->create())
            ->name($create->name)
            ->roleId($this->currentRole->id)
            ->roleName($this->currentRole->name)
            ->lifePoints($this->currentRole->lifePoints)
            ->strenght($this->currentRole->strenght)
            ->inteligence($this->currentRole->inteligence)
            ->dexterity($this->currentRole->dexterity)
            ->attack(
                $this->currentRole->attack->strenghtPercent,
                $this->currentRole->attack->inteligencePercent,
                $this->currentRole->attack->dexterityPercent,
            )
            ->velocity(
                $this->currentRole->velocity->strenghtPercent,
                $this->currentRole->velocity->inteligencePercent,
                $this->currentRole->velocity->dexterityPercent,
            )
            ->builder();

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

        $this->currentRole = $role;
    }
}
