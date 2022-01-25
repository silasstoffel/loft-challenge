<?php

/**
 * @OA\Post(
 *     path="/v1/fights",
 *     summary="Cria uma batalha",
 *     description="Cria uma batalha entre dois participantes",
 *     tags={"Fights"},
 *
 *     @OA\RequestBody(
 *         description="Informe os personagens",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/CreateFightRequest")
 *     ),
 *
 *     @OA\Response(
 *       response="200",
 *       description="Batalha encerrada com sucesso",
 *       @OA\JsonContent(ref="#/components/schemas/CreateFightResponse")
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
 *     )
 * )
 */
