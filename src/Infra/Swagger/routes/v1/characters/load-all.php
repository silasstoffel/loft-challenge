<?php

/**
 * @OA\Get(
 *     path="/v1/characters",
 *     summary="Lista dos personagens",
 *     description="Carrega uma lista dos personagens",
 *     tags={"Characters"},
 *
 *     @OA\Response(
 *       response="200",
 *       description="Lista dos personagens encontrados",
 *       @OA\JsonContent(type="array",  @OA\Items(ref="#/components/schemas/CharacterResponseLoadAll"))
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     )
 * )
 */
