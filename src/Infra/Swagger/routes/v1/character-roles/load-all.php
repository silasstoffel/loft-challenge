<?php

/**
 * @OA\Get(
 *     path="/v1/character-roles",
 *     summary="Lista de papeis (profissão) dos personagens",
 *     description="Carrega uma lista de papeis (profissão) dos personagens",
 *     tags={"Character Roles"},
 *
 *     @OA\Response(
 *       response="200",
 *       description="Lista de papeis (profissão) dos personagens encontrada",
 *       @OA\JsonContent(type="array",  @OA\Items(ref="#/components/schemas/CharacterRole"))
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
