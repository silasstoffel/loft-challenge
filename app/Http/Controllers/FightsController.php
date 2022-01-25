<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Loft\Application\Game\UseCase\Fight\CreateFight;

class FightsController extends Controller
{
    public function __construct(private CreateFight $useCase)
    {
    }

    public function store(Request $request): JsonResponse
    {
        $output = $this->useCase->execute(
            $request->character1,
            $request->character2
        );

        return $this->toJsonResponse($output->toArray());
    }
}
