<?php

namespace Loft\Domain\Game\Entities;

use InvalidArgumentException;

class Character
{
    private const STATUS_ALIVE = 'Alive';
    private const STATUS_DEAD  = 'Dead';

    public readonly string $name;
    private string $status;

    private int $calculatedVelocity = 0;
    private int $calculatedAttack = 0;

    private int $lifePoints;

    public function __construct(
        public readonly string $id,
        string $name,
        public readonly string $roleId,
        public readonly string $roleName,
        int $lifePoints,
        public readonly int $strenght,
        public readonly int $inteligence,
        public readonly int $dexterity,
        public readonly FightModifier $attack,
        public readonly FightModifier $velocity,
    ) {
        self::checkName($name);

        if ($lifePoints < 0) {
            throw new \InvalidArgumentException('Life points should be more than or equal 0.');
        }

        $this->name       = $name;
        $this->status     = $lifePoints > 0 ? self::STATUS_ALIVE : self::STATUS_DEAD;
        $this->lifePoints = $lifePoints;
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

    public function toArray($showStatus = false): array
    {
        $character = [
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

        if ($showStatus) {
            $character['status'] = $this->status;
        }

        return $character;
    }

    public function getStatus(): string
    {
        return $this->lifePoints > 0 ? self::STATUS_ALIVE : self::STATUS_DEAD;
    }

    public function calculateVelocity(): int
    {
        $value = $this->calculate($this->velocity);

        $this->calculatedVelocity = $value;

        return $value;
    }

    private function calculateAttack(): int
    {
        $value = $this->calculate($this->attack);

        $this->calculatedAttack = $value;

        return $value;
    }

    private function calculate(FightModifier $modifier): int
    {
        $base = 0;

        if ($modifier->dexterityPercent > 0) {
            $base += intval($this->dexterity / 100 * $modifier->dexterityPercent);
        }

        if ($modifier->inteligencePercent > 0) {
            $base += intval($this->inteligence / 100 * $modifier->inteligencePercent);
        }

        if ($modifier->strenghtPercent > 0) {
            $base += intval($this->strenght / 100 * $modifier->strenghtPercent);
        }

        return rand(0, $base);
    }

    public function getLifePoints(): int
    {
        return $this->lifePoints;
    }

    public function getCalculateAttack(): int
    {
        return $this->calculatedAttack;
    }

    public function getCalculateVelocity(): int
    {
        return $this->calculatedVelocity;
    }

    public function receiveAttack(Character $characterAttack)
    {
        $pointsBeforeAttack = $this->lifePoints;
        $pointsAttack       = $characterAttack->calculateAttack();

        $this->removeLifePoints($pointsAttack);

        return [
            'attacker' => [
                'name'         => $characterAttack->name,
                'points'       => $characterAttack->lifePoints,
                'attackPoints' => $pointsAttack,
            ],
            'defender' => [
                'name'               => $this->name,
                'pointsBeforeAttack' => $pointsBeforeAttack,
                'points'             => $this->lifePoints,
            ],
        ];
    }

    public function canReceiveAttack(): bool
    {
        return $this->lifePoints > 0;
    }

    private function removeLifePoints(int $points)
    {
        $this->lifePoints -= $points;
        if ($this->lifePoints <= 0) {
            $this->status     = self::STATUS_DEAD;
            $this->lifePoints = 0;
        }
    }
}
