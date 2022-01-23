<?php

namespace Loft\Domain\Game\Entities;

use InvalidArgumentException;

class Character
{
    private const STATUS_ALIVE = 'Alive';
    private const STATUS_DEAD  = 'Dead';

    public readonly string $name;
    private string $status;

    public function __construct(
        public readonly string $id,
        string $name,
        public readonly string $roleId,
        public readonly string $roleName,
        public readonly int $lifePoints,
        public readonly int $strenght,
        public readonly int $inteligence,
        public readonly int $dexterity,
        public readonly FightModifier $attack,
        public readonly FightModifier $velocity,
    ) {
        self::checkName($name);
        $this->name   = $name;
        $this->status = self::STATUS_ALIVE;
    }

    private static function checkName($name)
    {
        if (strlen($name) > 15) {
            throw new InvalidArgumentException('Max length for name is 15.');
        }

        $pattern = "/[a-zA-Z_]+/";
        preg_match($pattern, $name, $matches, PREG_OFFSET_CAPTURE);

        if (
            !count($matches)
            || (isset($matches[0][0]) && $matches[0][0] !== $name)
        ) {
            throw new InvalidArgumentException('Name should be to contain only letter or underscore.');
        }
    }

    public static function fromArray(array $data): self
    {
        $default = [
            'id'          => null,
            'name'        => null,
            'roleId'      => null,
            'roleName'    => null,
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
            $item['roleId'],
            $item['roleName'],
            $item['lifePoints'],
            $item['strenght'],
            $item['inteligence'],
            $item['dexterity'],
            $item['attack'],
            $item['velocity'],
        );
    }

    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'roleId'      => $this->roleId,
            'roleName'    => $this->roleName,
            'lifePoints'  => $this->lifePoints,
            'strenght'    => $this->strenght,
            'inteligence' => $this->inteligence,
            'dexterity'   => $this->dexterity,
            'attack'      => $this->attack->toArray(),
            'velocity'    => $this->velocity->toArray(),
        ];
    }

    public function getStatus(): string
    {
        return $this->lifePoints > 0 ? self::STATUS_ALIVE : self::STATUS_DEAD;
    }
}
