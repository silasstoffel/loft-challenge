<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Loft\Application\Game\UseCase\Character\Create;
use Loft\Application\Game\UseCase\Character\CreateDTO;
use Loft\Application\Game\UseCase\Character\LoadAll;
use Loft\Domain\Game\Entities\Character;

class CharactersController extends Controller
{
    public function __construct(
        private Create $createUseCase,
        private LoadAll $loadAllUseCase
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        $entity = $this->createUseCase->execute(
            CreateDTO::fromArray($request->all())
        );

        return $this->toJsonResponse($entity->toArray(), 201);
    }

    public function index(): JsonResponse
    {
        $results = $this->loadAllUseCase->execute();
        $items   = [];

        /** @var Character $results */
        foreach ($results as $result) {
            $items[] = [
                'id'   => $result->id,
                'name' => $result->name,
                'role' => $result->roleName,
                'status' => $result->getStatus(),
            ];
        }

        return $this->toJsonResponse($items);
    }

}
