<?php


namespace app\controllers;

use app\classes\Render;
use app\classes\Redirect;
use app\controllers\auth\LoginController as session;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($params = null)
    {
        $response = [
            'ua' => session::sessionValidate() ?? ['sv' => false],
            'title' => 'Stockfull',
            'code' => 200
        ];
        Render::view('home/home', $response);
    }
}