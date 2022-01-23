<?php

namespace Loft\Infra\Domain\Game\Repositories;

use Loft\Domain\Game\Entities\CharacterRole;
use Loft\Domain\Game\Entities\CharacterRoleBuilder;
use Loft\Domain\Game\Repositories\CharacterRoleRepositoryInterface;

class CharacterRoleRepository implements CharacterRoleRepositoryInterface
{
    /**
     * @var CharacterRole[]
     */
    private static array $items = [];

    public function __construct()
    {
        $builder = new CharacterRoleBuilder();
        self::$items[] = $builder
            ->id('4e552f4a-b49a-4c0b-a241-5d1249a0cd2f')
            ->name('Warrior')
            ->lifePoints(20)
            ->strenght(10)
            ->inteligence(5)
            ->dexterity(5)
            ->attack(80, 0, 20)
            ->velocity(0, 20, 60)
            ->builder();

        $builder = new CharacterRoleBuilder();
        self::$items[] = $builder
            ->id('a0a20b60-87c6-45ec-bb90-c6c1a2738f99')
            ->name('Thief')
            ->lifePoints(15)
            ->strenght(4)
            ->inteligence(4)
            ->dexterity(10)
            ->attack(25, 25, 100)
            ->velocity(0, 0, 80)
            ->builder();

        $builder = new CharacterRoleBuilder();
        self::$items[] = $builder
            ->id('38eb6e03-9af6-43cd-9bda-ae706e84c9c2')
            ->name('Mage')
            ->lifePoints(12)
            ->strenght(5)
            ->inteligence(10)
            ->dexterity(6)
            ->attack(20, 150, 50)
            ->velocity(20, 0, 50)
            ->builder();
    }

    public function findAll(): array
    {
        return self::$items;
    }

    public function findById(string $id): ?CharacterRole
    {
        $item = current(
            array_filter(self::$items, fn($item) => $item->id === $item)
        );

        return $item ?? null;
    }

    public function create(CharacterRole $characterRole)
    {
        self::$items[] = $characterRole;
    }
}
