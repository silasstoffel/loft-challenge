<?php

/** @var Router $router */

use Laravel\Lumen\Routing\Router;

$router->get('/', 'AppController@index');
$router->get('/alive', 'AppController@alive');
$router->get('/docs', 'AppController@docs');
