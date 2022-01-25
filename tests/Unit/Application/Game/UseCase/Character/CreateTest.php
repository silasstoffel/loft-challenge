<?php

namespace Tests\Unit\Application\Game\UseCase\Character;

use Loft\Application\Game\UseCase\Character\Create;
use Loft\Application\Game\UseCase\Character\CreateDTO;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;
use Loft\Infra\Domain\Game\Repositories\CharacterRoleRepository;
use Loft\Infra\Shared\PrimaryKey\UUIDCreator;
use Tests\TestCase;
use Tests\Unit\Application\Game\Mocks\CharacterRepositoryMock;

class CreateTest extends TestCase
{
    private CharacterRepositoryInterface $characterRepository;
    private Create $useCase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->characterRepository = new CharacterRepositoryMock();
        $this->useCase             = new Create(
            $this->characterRepository,
            new CharacterRoleRepository(),
            new UUIDCreator()
        );
    }

    public function testShouldNotBeAbleToCreateCharacterWithInvalidName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Name should be to contain only letter or underscore.');

        $dto = CreateDTO::fromArray([
            'name' => 'Invalid@Name',
            'role' => '4e552f4a-b49a-4c0b-a241-5d1249a0cd2f',
        ]);

        $this->useCase->execute($dto);
    }

    public function testShouldNotBeAbleToCreateCharacterWithInvalidRole()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid argument role or role not exists.');

        $dto = CreateDTO::fromArray([
            'name' => 'correct_name',
            'role' => '52b2bf4a-f4bc-487e-8eab-44d59de6eb38',
        ]);

        $this->useCase->execute($dto);
    }

    public function testShouldBeAbleToCreateCharacter()
    {
        $roleId = '4e552f4a-b49a-4c0b-a241-5d1249a0cd2f';
        $dto    = CreateDTO::fromArray([
            'name' => 'correct_name',
            'role' => $roleId,
        ]);

        $repository = new CharacterRoleRepository();
        $warrior    = $repository->findById($roleId);

        $character = $this->useCase->execute($dto);
        $this->assertIsString($character->id);
        $this->assertEquals('correct_name', $character->name);
        $this->assertEquals($warrior->lifePoints, $character->getLifePoints());
        $this->assertEquals($warrior->strenght, $character->strenght);
        $this->assertEquals($warrior->inteligence, $character->inteligence);
        $this->assertEquals($warrior->id, $character->roleId);
        $this->assertEquals($warrior->name, $character->roleName);
    }
}
