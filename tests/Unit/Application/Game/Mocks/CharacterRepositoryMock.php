<?php

namespace Tests\Unit\Application\Game\Mocks;

use Loft\Domain\Game\Entities\Character;
use Loft\Domain\Game\Entities\CharacterBuilder;
use Loft\Domain\Game\Entities\FightModifier;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;

class CharacterRepositoryMock implements CharacterRepositoryInterface
{
    /**
     * @var Character[]
     */
    private static array $items = [];

    public function __construct()
    {
        $builder = new CharacterBuilder();
        $entity  = $builder
            ->id('1')
            ->name('gamer_one')
            ->roleId('1')
            ->roleName('Warrior')
            ->lifePoints(20)
            ->strenght(10)
            ->inteligence(5)
            ->dexterity(5)
            ->attack(80, 0, 20)
            ->velocity(0, 20, 60)
            ->builder();

        $this->create($entity);

        $builder = new CharacterBuilder();
        $entity  = $builder
            ->id('2')
            ->name('gamer_two')
            ->roleId('2')
            ->roleName('Thief')
            ->lifePoints(15)
            ->strenght(4)
            ->inteligence(4)
            ->dexterity(10)
            ->attack(25, 25, 100)
            ->velocity(0, 0, 80)
            ->builder();

        $this->create($entity);

        $builder = new CharacterBuilder();
        $entity  = $builder
            ->id('3')
            ->name('gamer_three')
            ->roleId('3')
            ->roleName('Mage')
            ->lifePoints(12)
            ->strenght(5)
            ->inteligence(10)
            ->dexterity(6)
            ->attack(20, 150, 50)
            ->velocity(20, 0, 50)
            ->builder();

        $this->create($entity);

        $builder = new CharacterBuilder();
        $entity  = $builder
            ->id('4')
            ->name('without_points')
            ->roleId('3')
            ->roleName('Mage')
            ->lifePoints(0)
            ->strenght(5)
            ->inteligence(10)
            ->dexterity(6)
            ->attack(20, 150, 50)
            ->velocity(20, 0, 50)
            ->builder();

        $this->create($entity);
    }

    public function create(Character $character): void
    {
        self::$items[] = $character;
    }

    public function findById(string $id): ?Character
    {
        $filter = array_values(
            array_filter(self::$items, fn($a) => $a->id === $id)
        );

        return $filter[0] ?? null;
    }

    public function findByName(string $name): ?Character
    {
        $filter = array_values(
            array_filter(self::$items, fn($a) => $a->name === $name)
        );

        return $filter[0] ?? null;
    }

    public function findAll(): array
    {
        return self::$items;
    }

    public function updateLifePoints(string $characterId, int $points): void
    {
        foreach (self::$items as $key => $character) {
            if ($character->id === $characterId) {
                $data = $character->toArray(true);
                $data['attack'] = FightModifier::fromArray($data['attack']);
                $data['velocity'] = FightModifier::fromArray($data['velocity']);
                self::$items[$key] = Character::fromArray($data);
                break;
            }
        }
    }
}
