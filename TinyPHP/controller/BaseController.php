<?php

/**
 * class BaseController
 * 框架所有controller的基类
 *
 * @author sily
 */

class BaseController {

    protected $view;

    protected $_module;

    protected $_controller;

    protected $_action;

    protected $_param;


    public function __construct($module = 'Index', $controller = 'Home', $action = 'home', $param = array()) {
        //构造函数
        if ($module === null || $controller === null || $action === null) {
            die('invalide module or controller or action');
        }

        $this->_module = $module;
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_param = $param;
    }

    /**
     * Method getModuleName
     * 获取模型名称
     *
     * @return string $this->_modle
     * @author sily
     */
    public function getModuleName() {
        return $this->_module;
    }

    /**
     * Method getControllerName
     * 获取控制器名称
     *
     * @return string $this->_controller
     * @author sily
     */
    public function getControllerName() {
        return $this->_controller;
    }

    /**
     * Mtehod getActionName
     * 获取动作名称
     *
     * @return $this->_action
     * @author sily
     */
    public function getActionName() {
        return $this->_action;
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