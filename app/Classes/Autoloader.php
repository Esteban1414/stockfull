<?php

namespace app\classes;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($className)
    {
        if (!defined('CLASSES_PATH') || !defined('DS')) {
            throw new \Exception('CLASSES_PATH or DS constant is not defined.');
        }

        $filePath = CLASSES_PATH . str_replace('\\', DS, $className) . '.php';

        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            throw new \Exception("Class file '$filePath' does not exist.");
        }
    }
}

