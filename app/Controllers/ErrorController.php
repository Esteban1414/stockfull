<?php

namespace app\controllers;

use app\classes\Render;
use app\controllers\auth\LoginController as session;

class ErrorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function error404($params = null)
    {
        $response = [
            'ua' => session::sessionValidate() ?? ['sv' => false],
            'title' => 'Page not found – Stockfull',
            'code' => 404
        ];
        Render::view('home/error404', $response);
    }
}
