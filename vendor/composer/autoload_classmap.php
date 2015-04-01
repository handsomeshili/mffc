<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'BaseController' => $baseDir . '/TinyPHP/library/controller/BaseController.php',
    'BaseModel' => $baseDir . '/TinyPHP/library/model/BaseModel.php',
    'BaseRedis' => $baseDir . '/TinyPHP/service/BaseRedis.php',
    'BrandController' => $baseDir . '/app/modules/Brand/controllers/BrandController.php',
    'HomeController' => $baseDir . '/app/controllers/HomeController.php',
    'UserController' => $baseDir . '/app/modules/User/controllers/UserController.php',
    'Validator' => $baseDir . '/TinyPHP/service/Validator.php',
    'View' => $baseDir . '/TinyPHP/service/View.php',
    'Whoops\\Module' => $vendorDir . '/filp/whoops/src/deprecated/Zend/Module.php',
    'Whoops\\Provider\\Zend\\ExceptionStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/ExceptionStrategy.php',
    'Whoops\\Provider\\Zend\\RouteNotFoundStrategy' => $vendorDir . '/filp/whoops/src/deprecated/Zend/RouteNotFoundStrategy.php',
);
