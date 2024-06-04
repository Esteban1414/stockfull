<?php

namespace app\controllers\auth;

use app\classes\Redirect;
use app\controllers\Controller;
use app\classes\Render;
use app\controllers\auth\LoginController as session;

class RegisterController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $response = [
            'ua' => session::sessionValidate() ?? ['sv' => false],
            'title' => "Create Account – Stockfull",
            'code' => 200
        ];
        Render::view('home/register', $response);
    }

}