<?php

namespace app;

use app\classes\Autoloader as Autoloader;
use app\classes\Router as Router;

class App
{

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {

        $this->initConfig();
        $this->loadFunctions();
        $this->initAutoloader();
        $this->initRouter();

    }

    private function initConfig()
    {
        if(!file_exists('../config/config.php')){
            throw new \Exception('Configuration file is not defined.');
        }
        require_once '../config/config.php';
    }

    private function loadFunctions()
    {
        if (!file_exists(FUNCTIONS . 'main.php')) {
            throw new \Exception('Function main is not defined.');
        }
        require_once FUNCTIONS . 'main.php';

        if (!file_exists(FUNCTIONS . 'layouts.php')) {
            throw new \Exception('Function layout is not defined.');
        }
        require_once FUNCTIONS . 'layouts.php';
    }

    private function initAutoloader()
    {
        if (!file_exists(CLASSES . 'Autoloader.php')) {
            throw new \Exception('Autoloader file is not defined.');
        }
        require_once CLASSES . 'Autoloader.php';
        Autoloader::register();
        return;
    }

    private function initRouter()
    {
        if (!file_exists(CLASSES . 'Router.php')) {
            throw new \Exception('Router file is not defined.');
        }
        require_once CLASSES . 'Router.php';
        $router = new router();
        $router->route();
    }

    public static function run()
    {
        $App = new self();
        return;
    }
}
