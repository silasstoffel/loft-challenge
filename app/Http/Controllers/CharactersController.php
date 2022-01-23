<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Loft\Application\Game\UseCase\Character\Create;
use Loft\Application\Game\UseCase\Character\CreateDTO;

class CharactersController extends Controller
{
    public function __construct(
        private Create $createUseCase
    ) {
    }

    public function store(Request $request): JsonResponse
    {
        $entity = $this->createUseCase->execute(
            CreateDTO::fromArray($request->all())
        );

        return $this->toJsonResponse($entity->toArray(), 201);
    }

}
