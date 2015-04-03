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
     * Method loadServiceByName()
     * 根据路径加载一个类
     * @param string $service_name
     *
     */
    protected function loadServiceByName($service_name) {
        // $composer_autoload = require ROOT_PATH . '/vendor/autoload.php';

        $file = APPLICATION_PATH . '/services/' . $service_name . '.php';
        $file = str_replace('\\', '/', $file);
        require $file;
        // if (!file_exists($file)) {
        //     throw Exception('aquired file not exitsts');
        // }
        // $composer_autoload->add("System\\Serve", $file);
    }



    protected function loadModelByName($model_name) {
        //添加app/modules里面的更多模块
        $model_file = APPLICATION_PATH . '/models/' . $model_name . '.php';
        require $model_file;
        // $composer_autoload = require ROOT_PATH . '/vendor/autoload.php';
        // var_dump($composer_autoload->add("files", APPLICATION_PATH . '/models/' . $model_name . '.php'));
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
