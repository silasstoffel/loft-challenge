<?php

declare(strict_types=1);

namespace Loft\Infra\Domain\Game\Repositories;

use Loft\Domain\Game\Entities\FightModifier;
use Predis\Client;
use Loft\Domain\Game\Entities\Character;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;
use Loft\Infra\Caching\Redis\RedisClient;

class CharacterRepository implements CharacterRepositoryInterface
{
    private Client $redis;
    private const KEY_ITEMS_CACHE = 'characters:list';

    public function __construct(RedisClient $cache)
    {
        $this->redis = $cache->getClient();
    }

    public function create(Character $character): void
    {
        $items   = $this->getAll();
        $items[] = $character->toArray();

        $this->redis->set(self::KEY_ITEMS_CACHE, json_encode($items));
    }

    public function findById(string $id): ?Character
    {
        $items = $this->getAll();
        $item  = array_values(array_filter(
            $items,
            fn($character) => $character['id'] === $id
        ));

        if (isset($item[0])) {
            return $this->createCharacterFromArray($item[0]);
        }

        return null;
    }

    public function findByName(string $name): ?Character
    {
        $items = $this->getAll();
        $item  = array_values(array_filter(
            $items,
            fn($character) => $character['name'] === $name
        ));

        return isset($item[0]['id']) ? Character::fromArray($item[0]) : null;
    }

    private function getAll(): array
    {
        $characters = $this->redis->get(self::KEY_ITEMS_CACHE);
        return $characters ? json_decode($characters, true, JSON_THROW_ON_ERROR) : [];
    }

    public function findAll(): array
    {
        $results = $this->getAll();
        $data    = [];

        foreach ($results as $result) {
            $data[] = $this->createCharacterFromArray($result);
        }

        return $data;
    }

    private function createCharacterFromArray(array $result): Character
    {
        $attack           = $result['attack'];
        $modifier         = FightModifier::fromArray($attack);
        $result['attack'] = $modifier;

        $velocity           = $result['velocity'];
        $modifier           = FightModifier::fromArray($velocity);
        $result['velocity'] = $modifier;

        return Character::fromArray($result);
    }
}
