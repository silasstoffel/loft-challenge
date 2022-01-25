<?php

namespace Tests\Unit\Application\Game\UseCase\Fight;

use Loft\Application\Game\UseCase\Fight\CreateFight;
use Loft\Application\Game\UseCase\Fight\CreateFightOutput;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;
use Tests\TestCase;
use Tests\Unit\Application\Game\Mocks\CharacterRepositoryMock;

class CreateFightTest extends TestCase
{

    private CharacterRepositoryInterface $characterRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->characterRepository = new CharacterRepositoryMock();
    }

    public function testShouldNotBeAbleToStartFightWithFirstArgInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Character 1 is not valid or not exists.');

        $useCase = new CreateFight($this->characterRepository);
        $useCase->execute('123456', '2');
    }

    public function testShouldNotBeAbleToStartFightWithSecondArgInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Character 2 is not valid or not exists.');

        $useCase = new CreateFight($this->characterRepository);
        $useCase->execute('1', '123456');
    }

    public function testShouldNotBeAbleToStartFightWithoutLifePoints()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage("Character 1 don't have life points.");

        $useCase = new CreateFight($this->characterRepository);
        $useCase->execute('4', '1');
    }

    public function testShouldBeAbleToCreateAFight()
    {
        $useCase = new CreateFight($this->characterRepository);
        $output = $useCase->execute('1', '2');

        $this->assertInstanceOf(CreateFightOutput::class, $output);

        $winner = $this->characterRepository->findById($output->winnerId);
        $loser = $this->characterRepository->findById($output->loserId);

        $this->assertEquals($output->winnerPoints, $winner->getLifePoints());
        $this->assertEquals(0, $loser->getLifePoints());
        $this->assertIsArray($output->figthLogs);
    }
}
