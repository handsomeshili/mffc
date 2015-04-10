<?php

/**
 * index file, the only entrance file
 * created by sily at 2015-01-30
 */

define('ROOT_PATH', realpath(dirname(__FILE__) . '/../'));
define('APPLICATION_PATH', ROOT_PATH . '/app/');

//定义项目非默认模块路径
define('MODULES_PATH', APPLICATION_PATH . '/modules');

//定义项目自定义配置文件路径
define('CONFIG_PATH', ROOT_PATH . '/config');

define('HOST_NAME', '127.0.0.1:3000');

require '../TinyPHP/Application.php';
$app = new Application();
$app->run();


?>
