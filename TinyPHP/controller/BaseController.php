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
    //function : display(string $action_name) 
    //function : redirect(string $url)
    //

    public function __destruct(){
        $view = $this->view;

        if ($view instanceof View) {
            extract($view->data);

            require $view->view;
        }
    }

}









?>