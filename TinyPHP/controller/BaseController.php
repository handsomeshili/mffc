<?php

/**
 * class BaseController
 * 框架所有controller的基类
 *
 * @author sily
 */

class BaseController {

    protected $view;


    public function __construct() {
    }

    //获取视图类实例
    public function getView($action_name) {
        return View::make($action_name);
    }


    //function : redirect(string $url)
    public function redirect($request, $param = array()) {
        // $url = HOST_NAME . '/' . $request;
        // $encode_url = urlencode($url);
        // http_redirect($encode_url, $param);
        header("Location: $request");
        // header("Location: http://www.baidu.com");
        // http_redirect('www.baidu.com');
    }

    public function __destruct(){
        $view = $this->view;

        if ($view instanceof View) {
            extract($view->data);

            require $view->view;
        }
    }

}









?>