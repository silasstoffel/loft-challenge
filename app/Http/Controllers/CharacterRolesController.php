<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Loft\Application\Game\UseCase\CharacterRoles\LoadAll;

class CharacterRolesController extends Controller
{
    public function __construct(
        private LoadAll $useCase
    ) {
    }

    public function index(): JsonResponse
    {
        $data = array_map(
            fn($role) => $role->toArray(),
            $this->useCase->execute()
        );

        return $this->toJsonResponse($data);
    }
}
