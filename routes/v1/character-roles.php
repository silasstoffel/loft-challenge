<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->get('/character-roles', 'CharacterRolesController@index');
