<?php

/**
 * 路由分发文件,处理URL，指派对应的控制器处理该请求
 * @author sily
 *
 */


use NoahBuscher\Macaw\Macaw;

// Macaw::get('/', function() {
//     echo "hello /";
// });

// Macaw::get('/macaw', function() {
//     echo "hello macaw" . '<br />';
// });



// Macaw::get('/home', 'HomeController@home');

Macaw::get('/(:all)', function($request_name) {
    echo 'The slug is: ' . $request_name. '<br/>';

    $request_name = trim($request_name);
    $route = explode('/', $request_name);


    $request_len = count($route);

    if ($request_len >= 3) {
        //URL中获取module controller action  param
        $module = $route[0];
        $controller = $route[1];
        $action = $route[2];
        // $param = 
        Application::RouteDispatch($module, $controller, $action);

    } elseif ($request_len === 2) {
        //
        $module = 'Index';
        $controller = $route[0];
        $action = $route[1];
        Application::RouteDispatch($module, $controller, $action);
    } elseif ($request_len === 1) {
        //
        $module = 'Index';
        $controller = 'Home';
        $action = $route[0];
        Application::RouteDispatch($module, $controller, $action);
    } else {
        //
  }

});

//use 404 page as the not found tips
// Macaw::$error_callback = function() {
//     throw new Exception("路由无匹配项 404 Not Found");
// };

Macaw::dispatch();
?>
