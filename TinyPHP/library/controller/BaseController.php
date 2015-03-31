<?php

/**
 * class BaseController
 * 框架所有controller的基类
 *
 * @author sily
 */

class BaseController {

    protected $view;

    protected static $_module;

    public function __construct() {
    }


    /**
     * Method readConf()
     * 读取配置文件
     *
     */
    protected static function readConf() {
        $config = parse_ini_file(CONFIG_PATH . '/application.ini');
        return $config;
    }

    protected function loadmodel($model_name) {
        //添加app/modules里面的更多模块
        $composer_autoload = require ROOT_PATH . '/vendor/autoload.php';

        $con_ini = self::readConf();
        $app_mo = $con_ini['application.modules'];
        foreach ($app_mo as $mo_na) {
            $module_name = $mo_na;
            $composer_autoload->add("classmap", MODULES_PATH . '/' . $module_name . '/controllers');
        }
    }

    public static function setModule($module) {
        self::$_module = $module;
    }

    public static function getModule() {
        return self::$_module;
    }


    /**
     * function getView()
     * 获取视图类实例
     * @param $action_name
     * @return View | bool
     *
     */
    public function getView($action_name) {
        if ($action_name === null) {
            return false;
        }
        return View::make($action_name);
    }


    /**
     * function  redirect()
     * 重定向请求到新的路径
     *
     * @param string $url ---要定向的路径
     * @return 失败返回FALSE
     * 
     */
    public function redirect($request, $param = array()) {
        // $url = HOST_NAME . '/' . $request;
        // $encode_url = urlencode($url);
        // http_redirect($encode_url, $param);
        if ($request === null) {
            return false;
        }
        header("Location: $request");
    }



    //析构函数
    public function __destruct(){
        $view = $this->view;

        if ($view instanceof View) {
            extract($view->data);

            require $view->view;
        }
    }

}









?>