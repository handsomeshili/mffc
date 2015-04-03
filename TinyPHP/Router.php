<?php 

/**
 * class Router
 * 全局路由类
 * 
 */

class Router {

    protected static $_module;

    protected static $_controller;

    protected static $_action;

    protected static $_param;


    public function __construct(){}

    public static function init($route) {

        $request_len = count($route);

        $param = array();
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

        self::$_module = $module;
        self::$_controller = $controller;
        self::$_action = $action;
        self::$_param = $param;
    }

    public function getModule() {
        return self::$_module;
    }

    public function getController() {
        return self::$_controller;
    }

    public function getAction() {
        return self::$_action;
    }

    public function getParam() {
        return self::$_param;
    }

}



 ?>