<?php

/**
 * @OA\Post(
 *     path="/v1/characters",
 *     summary="Cria um personagem",
 *     description="Cria um usuário",
 *     tags={"Characters"},
 *
 *     @OA\RequestBody(
 *         description="Cadastra um personagem",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateCharactersRequest")
 *     ),
 *
 *     @OA\Response(
 *       response="201",
 *       description="Cadastro efetivado com sucesso.",
 *       @OA\JsonContent(ref="#/components/schemas/Character")
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Erro de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 *
 *     @OA\Response(
 *       response="422",
 *       description="Validação de uma ação disparada pelo consumidor",
 *       @OA\JsonContent(ref="#/components/schemas/Error")
 *     ),
 * )
 */
