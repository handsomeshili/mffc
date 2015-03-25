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
        echo "application initlized success<br />";
        

        //import autoload file
        require '../vendor/autoload.php';


        /**
         * Eloqent ROM 包支持
         *
         *
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
         * 
         *
         */
        $whoops = new \Whoops\Run;
        $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

        $whoops->register();

        /**
         * 用户自定义配置文件
         * 
         */
        require "../bootstrap.php";

        //import router config file
        require '../config/routes.php';

    }

    /**
     * Method initlize
     * 框架初始化操作
     *
     * @author sily
     */
    public static function initlize() {
        
        //添加app/modules里面的更多模块
        $composer_autoload = require '../vendor/autoload.php';
        $module_name = 'User';
        $composer_autoload->add("classmap", MODULES_PATH . '/' . $module_name . '/controllers');


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
    public static function RouteDispatch($module = 'Index', $controller = 'Home', $action = 'home', $param = array()) {
        echo 'module: ' . $module . ' controller: ' . $controller . ' action: ' . $action . '<br />';
        echo 'params : ';
        var_dump($param);
        echo 'route dispatche from here'; 

        $base_controller = new BaseController($module, $controller, $param);
        // var_dump($base_controller->getModuleName());
        // $_GET['param'] = $param;
        //instanitate controller
        $controller = $controller . 'Controller';
        $con = new $controller();
        //call action method
        $con->$action();
    }

}





?>