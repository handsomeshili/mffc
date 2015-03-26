<?php

/**
 * class BaseController
 * 框架所有controller的基类
 *
 * @author sily
 */

class BaseController {

    protected $view;

    public static $_module;

    public function __construct() {
    }


    public function getModule() {
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