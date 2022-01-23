<?php

namespace Loft\Domain\Game\Entities;

class CharacterRole
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly int $lifePoints,
        public readonly int $strenght,
        public readonly int $inteligence,
        public readonly int $dexterity,
        public readonly FightModifier $attack,
        public readonly FightModifier $velocity,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $default = [
            'id'          => null,
            'name'        => null,
            'lifePoints'  => null,
            'strenght'    => null,
            'inteligence' => null,
            'dexterity'   => null,
            'attack'      => null,
            'velocity'    => null,
        ];

        $item = array_merge($default, $data);

        return new self(
            $item['id'],
            $item['name'],
            $item['lifePoints'],
            $item['strenght'],
            $item['inteligence'],
            $item['dexterity'],
            $item['attack'],
            $item['velocity']
        );
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'lifePoints'  => $this->lifePoints,
            'strenght'    => $this->strenght,
            'inteligence' => $this->inteligence,
            'dexterity'   => $this->dexterity,
            'attack'      => $this->attack,
            'velocity'    => $this->velocity,
        ];
    }

}
