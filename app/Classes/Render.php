<?php

namespace app\classes;

class Render
{
    public static function view($view, $data = [])
    {
        $d = as_object($data);
        require_once VIEWS . $view . '-view.php';
        exit();
    }
}
