<?php

namespace Loft\Domain\Game\Entities;

class FightModifier
{
    public function __construct(
        public readonly int $strenghtPercent,
        public readonly int $inteligencePercent,
        public readonly int $dexterityPercent
    ) {
    }

    public static function fromArray(array $data): self
    {
        $default = [
            'strenghtPercent'    => 0,
            'inteligencePercent' => 0,
            'dexterityPercent'   => 0,
        ];

        $item    = array_merge($default, $data);

        return new self(
            $item['strenghtPercent'],
            $item['inteligencePercent'],
            $item['dexterityPercent']
        );
    }

    public function toArray(): array
    {
        return [
            'strenghtPercent'    => $this->strenghtPercent,
            'inteligencePercent' => $this->inteligencePercent,
            'dexterityPercent'   => $this->dexterityPercent,
        ];
    }
}
