<?php

namespace Tests\Integration\app\Http\Controllers;

use Tests\TestCase;

class CharacterRolesControllerTest extends TestCase
{
    public function testShouldBeToRequestCharacterRoles()
    {
        $request = $this->json('GET','/v1/character-roles');
        $request->seeStatusCode(200);
        $items = json_decode($request->response->getContent(), true);

        $uuids = [
            '4e552f4a-b49a-4c0b-a241-5d1249a0cd2f',
            'a0a20b60-87c6-45ec-bb90-c6c1a2738f99',
            '38eb6e03-9af6-43cd-9bda-ae706e84c9c2'
        ];

        foreach ($uuids as $uuid) {
            $filter = current(array_values(
                array_filter($items, fn($a) => $a['id'] === $uuid)
            ));
            $this->assertEquals($uuid, $filter['id']);
        }

    }
}
