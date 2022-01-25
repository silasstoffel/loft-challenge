<?php

namespace Loft\Application\Game\UseCase\Fight;

class CreateFightOutput
{
    public function __construct(
        public readonly string $winnerId,
        public readonly string $winnerName,
        public int $winnerPoints,
        public readonly string $loserId,
        public readonly string $loserName,
        public readonly array $figthLogs
    ) {
    }

    public function toArray(): array
    {
        return [
            'winnerId'     => $this->winnerId,
            'winnerName'   => $this->winnerName,
            'winnerPoints' => $this->winnerPoints,
            'loserId'      => $this->loserId,
            'loserName'    => $this->loserName,
            'figthLogs'    => $this->figthLogs,
        ];
    }
}
