<?php
/**
 * class Application
 * 全局配置，框架运行初始类，在public/index.php里面实例化这个类，然后这个类在initlize()函数里面做最基本的框架初始化操作
 *
 * @author sily
 */

use Illuminate\Database\Capsule\Manager as Capsule;


class Application {

    protected static $_config;

    /**
     * Method __construct()
     * 构造函数
     *
     * @author sily
     */
    public function __construct() {
        //import autoload file
        require '../vendor/autoload.php';

        //读取配置文件，并加载到框架中
        self::$_config = $this->initConf();

        //加载公共函数库文件
        require "library/functions/Common.php";

        /**
         * Eloqent ROM 包支持
         * Eloqent ROM  git adress: https://github.com/illuminate/database
         */
        if (file_exists(CONFIG_PATH . '/database.php')) {
            $capsule = new Capsule;
            $capsule->addConnection(require CONFIG_PATH . '/database.php');
            //Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
            $capsule->bootEloquent();
        }

        
        /**
         * whoops 错误提示包支持
         * 根据配置项application.throwException配置选择是否开启
         */
        if (self::$_config['application']['throwException']) {
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        }


        //用户自定义配置文件
        require CONFIG_PATH . "/bootstrap.php";

        //import router config file
        require 'system/routes.php';

    }

    /**
     * @undone
     * Method readConf()
     * 读取配置文件 并组合成一个方便查询的新数组
     * @return array $new_config
     */
    protected static function initConf() {
        $config = parse_ini_file(CONFIG_PATH . '/application.ini',true, INI_SCANNER_RAW);
        $new_config = array();
        foreach ($config as $ck => $cv) {
            switch ($ck) {
                case 'product':
                    foreach ($cv as $pk => $pv) {
                        $point_pos = strpos($pk, '.');
                        $conf_name = substr($pk, $point_pos + 1);
                        $new_config['application'][$conf_name] = $pv;
                    }
                    break;
                case 'database':
                    $new_config['database'] = $config['database'];
                    break;
                default:
                    # code...
                    $new_config = array();
                    break;
            }
        }
        return $new_config;
    }

    public static function getSysConfig() {
        return self::$_config;
    }



    /**
     * Method initlize
     * 框架初始化操作
     *
     * @author sily
     */
    public static function run() {

        $m = Router::getModule();
        $c = Router::getController();
        $a = Router::getAction();
        $p = Router::getParam();
        self::RouteDispatch($m, $c, $a, $p);


        //添加app/modules里面的更多模块
        // $composer_autoload = require ROOT_PATH . '/vendor/autoload.php';
        //
        // $con_ini = self::readConf();
        // $app_mo = $con_ini['application.modules'];
        // foreach ($app_mo as $mo_na) {
        //     $module_name = $mo_na;
        //     $composer_autoload->add("classmap", MODULES_PATH . '/' . $module_name . '/controllers');
        // }
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
        dump($param);
        echo '<br />route dispatche from here<br />';

        // BaseController::$_module = $module;
        BaseController::setModule($module);
        $controller = $controller . 'Controller';
        $con = new $controller();
        //call action method
        $con->$action();
    }

}





