<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->post('/fights', 'FightsController@store');
