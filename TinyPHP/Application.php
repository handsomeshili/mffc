<?php
/**
 * class Application
 * 全局配置，框架运行初始类，在public/index.php里面实例化这个类，然后这个类在initlize()函数里面做最基本的框架初始化操作
 *
 * @author sily
 */

use Illuminate\Database\Capsule\Manager as Capsule;


class Application {

    /**
     * Method __construct()
     * 构造函数
     *
     * @author sily
     */
     


    public function __construct() {


        //codes.......

        //import autoload file
        require '../vendor/autoload.php';


        /**
         * Eloqent ROM 包支持
         * Eloqent ROM  git adress: https://github.com/illuminate/database
         *
         */
        $capsule = new Capsule;

        //读取配置文件
        $capsule->addConnection(require '../config/database.php');
        //Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();



        /**
         * whoops 错误提示包支持
         *
         */
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

        $whoops->register();

        /**
         * 用户自定义配置文件
         *
         */
        require CONFIG_PATH . "/bootstrap.php";

        //加载公共函数库文件
        require "library/functions/Common.php";


        //import router config file
        require CONFIG_PATH . '/routes.php';

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


    /**
     * Method initlize
     * 框架初始化操作
     *
     * @author sily
     */
    public static function initlize() {

        //添加app/modules里面的更多模块
        $composer_autoload = require ROOT_PATH . '/vendor/autoload.php';

        $con_ini = self::readConf();
        $app_mo = $con_ini['application.modules'];
        foreach ($app_mo as $mo_na) {
            $module_name = $mo_na;
            $composer_autoload->add("classmap", MODULES_PATH . '/' . $module_name . '/controllers');
        }

        echo '<br />' . 'initlized' . '<br/>';
    }


    /**
     * Method RouteDispatche
     * 路由分发
     * @param string $module
     * @param string $controller
     * @param string $action
     * @param array $param
     *
     * @author sily
     */
    public static function RouteDispatch($module = '', $controller = '', $action = '', $param = array()) {

        //ucword
        $module = ucfirst(strtolower($module));
        $controller = ucfirst(strtolower($controller));

        echo 'module: ' . $module . ' controller: ' . $controller . ' action: ' . $action . '<br />';
        echo 'params : ';
        var_dump($param);
        echo '<br />route dispatche from here<br />';

        // BaseController::$_module = $module;
        BaseController::setModule($module);
        $controller = $controller . 'Controller';
        $con = new $controller();
        //call action method
        $con->$action();
    }

}





?>
