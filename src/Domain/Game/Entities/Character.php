<?php

namespace Loft\Domain\Game\Entities;

use InvalidArgumentException;

class Character
{
    public readonly string $name;

    public function __construct(
        public readonly string $id,
        string $name,
        public readonly string $roleId
    ) {
        self::checkName($name);
        $this->name = $name;
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
            'id'   => null,
            'name' => null,
            'role' => null,
        ];

        $item = array_merge($default, $data);

        return new self(
            $item['id'],
            $item['name'],
            $item['roleId'],
        );
    }

    public function toArray(): array
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'roleId' => $this->roleId,
        ];
    }
}
