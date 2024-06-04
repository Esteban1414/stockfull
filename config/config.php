<?php
date_default_timezone_set('America/Mexico_City');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

define('IS_LOCAL', in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1']) ? true : false);
define('URL', IS_LOCAL ? 'http://stockfull.com/' : 'REMOTE URL');

define('CLASSES', ROOT . 'app/Classes' . DS);
define('CLASSES_PATH', ROOT . 'app/..' . DS);

define('VIEWS', ROOT . 'app/Views/' . DS);
define('LAYOUTS', VIEWS . 'layouts/' . DS);
define('FUNCTIONS', ROOT . 'config/functions/' . DS);

define('SRC', URL . 'src' . '/');
define('CSS', SRC . 'css/');
define('JS', SRC . 'js/');
define('ASSETS', SRC . 'assets' . '/');