<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Loft\Application\Game\UseCase\Character\Create;
use Loft\Application\Game\UseCase\Character\CreateDTO;
use Throwable;

class CreateInitialCharactersSeeder extends Seeder
{
    public function run()
    {
        try {
            $useCase = app(Create::class);

            // warrior
            $php = CreateDTO::fromArray([
                'name' => 'php_app',
                'role' => '4e552f4a-b49a-4c0b-a241-5d1249a0cd2f',
            ]);

            // Mage
            $node = CreateDTO::fromArray([
                'name' => 'node_app',
                'role' => '38eb6e03-9af6-43cd-9bda-ae706e84c9c2',
            ]);

            $useCase->execute($php);
            $useCase->execute($node);
        } catch (Throwable) {
            return;
        }
    }
}
