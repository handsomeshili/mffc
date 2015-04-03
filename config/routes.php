<?php

/**
 * 路由分发文件,处理URL，指派对应的控制器处理该请求
 * @author sily
 *
 */


use NoahBuscher\Macaw\Macaw;


Macaw::get('/(:all)', function($request_name) {

    //从uri中获取module、controller、action
    $request_name = trim($request_name);
    $route = explode('/', $request_name);

    require '../TinyPHP/Router.php';
    Router::init($route);

});

//use 404 page as the not found tips
Macaw::$error_callback = function() {
    throw new Exception("路由无匹配项 404 Not Found");
};

Macaw::dispatch();
?>
