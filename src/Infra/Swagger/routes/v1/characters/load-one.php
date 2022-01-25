<?php

/**
 * @OA\Get(
 *     path="/v1/characters/{id}",
 *     summary="Carrega um personagem",
 *     description="Carrega dados de um personagem pelo ID",
 *     tags={"Characters"},
 *
 *     @OA\Parameter(
 *         description="ID",
 *         in="path",
 *         name="id",
 *         required=true,
 *         @OA\Schema(
 *           type="string"
 *         )
 *     ),
 *
 *     @OA\Response(
 *       response="200",
 *       description="Cadastro encontrado sucesso",
 *       @OA\JsonContent(ref="#/components/schemas/Character")
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 *
 * )
 */
