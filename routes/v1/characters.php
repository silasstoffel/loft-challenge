<?php

use Laravel\Lumen\Routing\Router;


/** @var Router $router */
$router->group(
    ['prefix' => '/characters'],
    function () use ($router) {
        $router->get('/', 'CharactersController@index');
        $router->get('/{id}', 'CharactersController@get');
        $router->post('/', 'CharactersController@store');
    }
);
