<?php

/**
 * class Session
 * 对系统$_SESSION的封装
 *
 */

class Session {

    // public static Yaf_Session getInstance ( void );
    // public Yaf_Session start ( void );
    // public mixed get ( string $name = NULL );
    // public boolean set ( string $name ,
    // mixed $value );
    // public mixed __get ( string $name );
    // public boolean __set ( string $name ,
    // mixed $value );
    // public boolean has ( string $name );
    // public boolean del ( string $name );
    // public boolean __isset ( string $name );
    // public boolean __unset ( string $name );


    public function __construct() {
        //no session under cli
        if (php_sapi_name() === 'cli') {
            return false;
        }

        //100 minutes expire time , php default value is 180
        session_cache_expire(100);
        session_start();
        session_regenerate_id(TRUE);    //每次从新加载都会产生一个新的session id
        int_set("session.use_only_cookies", 1);     //表示只使用cookies存放session id，这可以避免session固定攻击
    }

    public function init() {
        //do something
    }

    public function index() {}

    //
    public static function set($name, $value,$expire = 100) {
        // $ser_value = serialize($value);
        // $en_ser_value = session_encode($ser_value);
        // $_SESSION[$name] = $enco_ser_value;
        $_SESSION[$name] = $value;
    }

    //
    public static function get($name) {
        // $de_value = session_decode($_SESSION[$name]);
        // $value = unserialize($de_value);
        $value = $_SESSION[$name];
        return $value;
    }

    public static function has($name) {
        if (!empty($_SESSION[$name])) {
            return true;
        } else {
            return false;
        }
    }

    public static function del($name) {
        unset($_SESSION[$name]);
    }
}

