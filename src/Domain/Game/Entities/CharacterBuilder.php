<?php

namespace Loft\Domain\Game\Entities;

class CharacterBuilder
{
    private array $attack;
    private array $velocity;
    private array $character = [
        'id'          => null,
        'name'        => null,
        'roleId'      => null,
        'roleName'    => null,
        'lifePoints'  => 0,
        'strenght'    => 0,
        'inteligence' => 0,
        'dexterity'   => 0,
    ];

    public function __construct()
    {
        $data           = [
            'strenghtPercent'    => 0,
            'inteligencePercent' => 0,
            'dexterityPercent'   => 0,
        ];
        $this->attack   = $data;
        $this->velocity = $data;
    }

    public function id(string $id): self
    {
        $this->character['id'] = $id;

        return $this;
    }

    public function name(string $name): self
    {
        $this->character['name'] = $name;

        return $this;
    }


    public function roleId(string $id): self
    {
        $this->character['roleId'] = $id;

        return $this;
    }

    public function roleName(string $name): self
    {
        $this->character['roleName'] = $name;

        return $this;
    }

    public function lifePoints(int $name): self
    {
        $this->character['lifePoints'] = $name;

        return $this;
    }

    public function strenght(int $strenght): self
    {
        $this->character['strenght'] = $strenght;
        return $this;
    }

    public function inteligence(int $inteligence): self
    {
        $this->character['inteligence'] = $inteligence;

        return $this;
    }

    public function dexterity(int $dexterity): self
    {
        $this->character['dexterity'] = $dexterity;

        return $this;
    }

    public function velocity(
        int $strenghtPercent = 0,
        int $inteligencePercent = 0,
        int $dexterityPercent = 0
    ): self {
        $this->velocity = [
            'strenghtPercent'    => $strenghtPercent,
            'inteligencePercent' => $inteligencePercent,
            'dexterityPercent'   => $dexterityPercent,
        ];

        return $this;
    }

    public function attack(
        int $strenghtPercent = 0,
        int $inteligencePercent = 0,
        int $dexterityPercent = 0
    ): self {
        $this->attack = [
            'strenghtPercent'    => $strenghtPercent,
            'inteligencePercent' => $inteligencePercent,
            'dexterityPercent'   => $dexterityPercent,
        ];

        return $this;
    }

    public function builder(): Character
    {
        $data             = $this->character;
        $data['attack']   = FightModifier::fromArray($this->attack);
        $data['velocity'] = FightModifier::fromArray($this->velocity);

        return Character::fromArray($data);
    }
}
