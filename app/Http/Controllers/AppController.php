<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AppController
{
    public function docs(): RedirectResponse
    {
        return redirect('/swagger/index.html');
    }

    public function index(): Response
    {
        return response([
            'version' => '0.0.1',
            'name'    => env('APP_NAME'),
        ]);
    }

    public function alive(): Response
    {
        $date = new \DateTime();

        return response([
            'message' => "I'm alive",
            'date' => $date->format('c')
        ]);
    }
}
