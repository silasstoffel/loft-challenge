<?php

/**
 * @OA\Schema(
 *   schema="CreateFightResponse",
 *   title="CreateFightResponse",
 *
 *   @OA\Property(
 *     property="winnerId",
 *     type="string",
 *     description="Id do personagem vencedor"
 *   ),
 *
 *   @OA\Property(
 *     property="winnerName",
 *     type="string",
 *     description="Nome do personagem vencedor"
 *   ),
 *
 *   @OA\Property(
 *     property="winnerPoints",
 *     type="number",
 *     description="Pontos restantes do personagem vencedor"
 *   ),
 *
 *   @OA\Property(
 *     property="loserId",
 *     type="string",
 *     description="Id do personagem derrotado"
 *   ),
 *
 *   @OA\Property(
 *     property="loserName",
 *     type="string",
 *     description="Nome do personagem derrotado"
 *   ),
 *
 *  @OA\Property(
 *     property="figthLogs",
 *     type="array",
 *     @OA\Items(type="array", @OA\Items()),
 *     description="Logs do combate"
 *   )
 * )
 */




