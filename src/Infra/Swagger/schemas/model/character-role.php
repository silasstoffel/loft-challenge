<?php

/**
 * @OA\Schema(
 *   schema="CharacterRole",
 *   title="CharacterRole",
 *   required={"name", "id", "lifePoints", "strenght", "inteligence"},
 *
 *   @OA\Property(
 *     property="id",
 *     type="string",
 *     description="Id"
 *   ),
 *
 *   @OA\Property(
 *     property="name",
 *     type="string",
 *     description="Nome"
 *   ),
 *
 *   @OA\Property(
 *     property="lifePoints",
 *     type="number",
 *     description="Pontos de vida"
 *   ),
 *
 *  @OA\Property(
 *     property="strenght",
 *     type="number",
 *     description="Força"
 *   ),
 *
 *  @OA\Property(
 *     property="inteligence",
 *     type="number",
 *     description="Inteligencia"
 *   ),
 *
 *  @OA\Property(
 *     property="dexterity",
 *     type="number",
 *     description="Destreza"
 *   ),
 *
 *  @OA\Property(
 *     property="attack",
 *     description="Modificador de ataque",
 *     ref="#/components/schemas/FightModifier"
 *   ),
 *
 *  @OA\Property(
 *     property="velocity",
 *     ref="#/components/schemas/FightModifier"
 *   )
 * )
 */




