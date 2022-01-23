<?php

namespace Loft\Application\Game\UseCase\Character;

class CreateDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $role,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $default = [
            'name' => null,
            'role' => null,
        ];
        $attr    = array_merge($default, $data);

        return new CreateDTO($attr['name'], $attr['role']);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
        ];
    }
}
