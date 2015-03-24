<?php

/**
 * index file, the only entrance file
 * created by sily at 2015-01-30
 */

define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
define('APPLICATION_PATH', ROOT_PATH . '/app/');

require '../TinyPHP/Application.php';
$app = new Application();
$app->initlize();


?>
