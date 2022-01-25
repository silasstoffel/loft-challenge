<?php

namespace Loft\Application\Game\UseCase\Fight;

use Loft\Domain\Game\Entities\Character;
use Loft\Domain\Game\Repositories\CharacterRepositoryInterface;

class CreateFight
{
    private ?Character $character1;
    private ?Character $character2;
    private Character $firstGamer;
    private Character $secondGamer;
    private Character $winner;
    private Character $loser;
    private array $logs;

    public function __construct(private CharacterRepositoryInterface $repository)
    {
        $this->logs = [];
    }

    public function execute(string $character1, string $character2): CreateFightOutput
    {
        $this->loadCharacters($character1, $character2);
        $this->check();
        $this->definesWhoInitiatesAttack();
        $this->figth();

        $this->repository->updateLifePoints($this->loser->id, 0);
        $this->repository->updateLifePoints($this->winner->id, $this->winner->getLifePoints());

        return new CreateFightOutput(
            $this->winner->id,
            $this->winner->name,
            $this->winner->getLifePoints(),
            $this->loser->id,
            $this->loser->name,
            $this->logs
        );
    }

    private function check()
    {
        if (is_null($this->character1)) {
            throw new \InvalidArgumentException('Character 1 is not valid or not exists.');
        }

        if (is_null($this->character2)) {
            throw new \InvalidArgumentException('Character 2 is not valid or not exists.');
        }

        if (!$this->character1->getLifePoints()) {
            throw new \DomainException("Character 1 don't have life points.");
        }

        if (!$this->character2->getLifePoints()) {
            throw new \DomainException("Character 2 don't have life points.");
        }
    }

    private function loadCharacters(string $character1, string $character2): void
    {
        $this->character1 = $this->repository->findById($character1);
        $this->character2 = $this->repository->findById($character2);
    }

    private function definesWhoInitiatesAttack()
    {
        while (true) {
            $gamer1 = $this->character1->calculateVelocity();
            $gamer2 = $this->character2->calculateVelocity();

            if ($gamer1 === $gamer2) {
                continue;
            }

            if ($gamer1 > $gamer2) {
                $this->firstGamer  = $this->character1;
                $this->secondGamer = $this->character2;
                break;
            }

            $this->firstGamer  = $this->character2;
            $this->secondGamer = $this->character1;
            break;
        }

        $this->logStartsfight();
    }

    private function logStartsfight()
    {
        $this->logs[] = sprintf(
            '%s (%s) foi mais veloz que o %s (%s) e irá começar!',
            $this->firstGamer->name,
            $this->firstGamer->getCalculateVelocity(),
            $this->secondGamer->name,
            $this->secondGamer->getCalculateVelocity()
        );
    }

    private function figth()
    {
        $round = 0;

        while (true) {
            if ($round % 2 === 0) {
                $this->attack($this->firstGamer, $this->secondGamer, $round + 1);
                $defender = $this->secondGamer;
                $attacker = $this->firstGamer;
            } else {
                $this->attack($this->secondGamer, $this->firstGamer, $round + 1);
                $defender = $this->firstGamer;
                $attacker = $this->secondGamer;
            }

            if (!$defender->canReceiveAttack()) {
                $this->winner = $attacker;
                $this->loser  = $defender;
                break;
            }

            $round++;
        }

        $this->logs[] = sprintf(
            '%s venceu a batalha! %s possui %s pontos de vida restante!',
            $this->winner->name,
            $this->winner->name,
            $this->winner->getLifePoints()
        );
    }

    private function attack(Character &$attacker, Character &$defender, int $round): array
    {
        $result = $defender->receiveAttack($attacker);

        $this->logs[] = sprintf(
            '%sº Round: %s atacou %s com %s de dano, %s com %s pontos de vida restantes, antes do ataque os pontos eram (%s);',
            $round,
            $attacker->name,
            $defender->name,
            $result['attacker']['attackPoints'],
            $defender->name,
            $result['defender']['points'],
            $result['defender']['pointsBeforeAttack']
        );

        return $result;
    }
}
