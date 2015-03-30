<?php 
/**
 * class BaseRedis 
 * redis驱动类
 */

// use Predis\Client;

class BaseRedis {
    const CONFIG_FILE = '/redis.php';

    protected static $redis;

    public static function init() {
        // self::$redis = new Client(require ROOT_PATN . self::CONFIG_FILE);
        self::$redis = new Redis();
        $config = require CONFIG_PATH . self::CONFIG_FILE;
        self::$redis->connect($config['host'], $config['port']) or die('can not connect to redis server');
    }


    public static function getInstance() {
        self::init();
        return self::$redis;
    }

    public static function set($key, $value, $time = null, $unit = null) {
        if ($time) {
            switch ($unit) {
                case 'h':
                    # code...
                    $time *= 3600;
                    break;
                case 'm':
                    $time *= 60;
                    break;
                case 's':
                case 'ms':
                default:
                    throw new InvalidArgumentException('单位只能是 h m s ms');
                    break;
            }

            if ($unit == 'ms') {
                self::_psetex($key, $value, $time);
            } else {
                self::_setex($key, $value, $time);
            }

        } else {
            self::$redis->set($key, $value);
        }
    }

    public static function _setex($key, $value, $time) {
        self::$redis->setex($key, $time, $value);
    }

    public static function _psetex($key, $value, $time) {
        self::$redis->psetex($key, $time, $value);
    }


    public static function get($key) {
        return self::$redis->get($key);
    } 

    public static function delete($key) {
        return self::$redis->del($key);
    }


    public static function exits($key) {
        if (!self::$redis->exits($key)) {
            return false;
        } else {
            return true;
        }
    }

    //自加1
    public static function Incr($key) {
        if (!is_int(self::$redis->get($key))) {
            return false;
        } else {
            self::$redis->incr($key);
            return true;
        }
    }

    //加上$by
    public static function IncrBy($key, $by) {
        if (!is_int(self::$redis($key)) || !is_int($by)) {
            return false;
        } else {
            self::$redis->incrBy($key, $by);
            return true;
        }
    }

    //加上$float
    public static function incrByFloat($key, $float) {
        if (self::$redis->incrByFloat($key, $float)) {
            return true;
        } else {
            return false;
        }
    } 

    //自减1
    public static function decr($key) {
        if (!is_int(self::$redis->get($key))) {
            return false;
        } else {
            self::$redis->decr($key);
            return true;
        }
    }

    //自减$by
    public static function decrBy($key, $by) {
        if (!is_int(self::$redis($key)) || !is_int($by)) {
            return false;
        } else {
            self::$redis->decrBy($key, $by);
            return true;
        }
    }




}

?>