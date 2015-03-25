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

    $request_len = count($route);

    if ($request_len >= 3) {
        //URL中获取module controller action  param
        $module = $route[0];
        $controller = $route[1];
        $action = $route[2];
        
        //获取action后面的参数,例如: /Index/Home/home/d/1 => d=1
        $param = array();
        for ($i = 3; $i < $request_len - 1; $i++) {
            $param[$route[$i]] = $route[$i + 1];
        }
    } elseif ($request_len === 2) {
        //使用默认的模块
        $module = 'Index';
        $controller = $route[0];
        $action = $route[1];
    } elseif ($request_len === 1) {
        //使用默认的模块和控制器
        $module = 'Index';
        $controller = 'Home';
        $action = $route[0];
    } else {
        //使用默认的模块和控制器、动作
        $module = 'Index';
        $controller = 'Home';
        $action = 'home';
  }
  //调用Application的分发函数
  Application::RouteDispatch($module, $controller, $action);

});

// //use 404 page as the not found tips
// Macaw::$error_callback = function() {
//     throw new Exception("路由无匹配项 404 Not Found");
// };

Macaw::dispatch();
?>
