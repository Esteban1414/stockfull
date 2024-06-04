<?php
namespace app\classes;

use app\controllers\HomeController as Home;
use app\controllers\ErrorController as Error;
use app\controllers\auth\LoginController as Login;

class router
{
    private $url = "";
    public function __construct()
    {
    }

    public function route()
    {
        $this->filterRequest();
        $controller = $this->getController();
        $action     = $this->getAction();
        $params     = $this->getParams();
        switch ($controller) {
            case 'HomeController':
                $controller = new Home();
                break;
            case 'LoginController':
                $controller = new Login();
                break;
            default:
                $controller = new Error();
                $action = 'error404';
        }
        
        if (method_exists($controller, $action)) {
            $controller->$action($params);
        } else {
            $controller = new Error();
            $action = 'error404';
            $controller->$action($params);
        }

        return;
    }

    private function filterRequest()
    {
        $peticion = filter_input_array(INPUT_GET);
        if (isset($peticion['url'])) {
            $this->url = $peticion['url'];
            $this->url = rtrim($this->url, '/');
            $this->url = filter_var($this->url, FILTER_SANITIZE_URL);
            $this->url = explode("/", ucfirst(strtolower($this->url)));
            return;
        }
    }

    private function getController()
    {
        if (isset($this->url[0])) {
            $controller = $this->url[0];
            unset($this->url[0]);
        } else {
            $controller = "home";
        }
        $controller = ucfirst($controller) . 'Controller';
        return $controller;
    }

    private function getAction()
    {
        if (isset($this->url[1])) {
            $action = $this->url[1];
            unset($this->url[1]);
        } else {
            $action = "index";
        }
        return $action;
    }

    private function getParams()
    {
        $params = [];
        if (!empty($this->url)) {
            $params = $this->url;
        }
        return $params;
    }
}
